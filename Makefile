PHP        ?= php
COMPOSER   ?= composer
RM         ?= rm
FIND       ?= find
PRINTF     ?= printf
HEAD       ?= head
GIT        ?= git

HOST       ?= localhost
PORT       ?= 8000
SRC        ?= src
DIST       ?= dist
BIN        ?= bin
VENDOR     ?= vendor

BUILD_SH   := build.php
DIST_SH    := $(BIN)/build-dist.php
BUILD_OUT  := $(SRC)/build-info.php

CS_FIXER   := $(VENDOR)/bin/php-cs-fixer
PHPSTAN    := $(VENDOR)/bin/phpstan
CS_CONFIG  := .php-cs-fixer.dist.php
STAN_CONFIG := phpstan.neon
AUTOLOAD   := $(VENDOR)/autoload.php
MEM_LIMIT  := 256M

PHP_SERVE  := $(PHP) -S $(HOST):$(PORT) -t
PHP_LINT   := $(PHP) -l
PHP_RUN    := $(PHP) -r
PHP_BUILD  := $(PHP) $(BUILD_SH)
PHP_DIST   := $(PHP) $(DIST_SH)

CS_FIX     := $(PHP) $(CS_FIXER) fix --config=$(CS_CONFIG)
CS_DRY     := $(PHP) $(CS_FIXER) fix --dry-run --diff --config=$(CS_CONFIG)
STAN_RUN   := $(PHP) $(PHPSTAN) analyse -c $(STAN_CONFIG) --memory-limit=$(MEM_LIMIT) --no-progress

COMP_INSTALL := $(COMPOSER) install --no-interaction --prefer-dist

FIND_PHP     := $(FIND) $(SRC) $(BIN) -name '*.php'
LINT_LOOP    := failed=0; for f in $$($(FIND_PHP)); do $(PHP_LINT) "$$f" > /dev/null 2>&1 || { $(PHP_LINT) "$$f"; failed=1; }; done; if [ $$failed -eq 0 ]; then $(PRINTF) 'syntax ok\n'; else exit 1; fi

VERSION_CMD  := try { $$i = include "$(BUILD_OUT)"; echo ($$i["hash"] ?? "unknown"), PHP_EOL; } catch (Throwable $$e) { echo "invalid", PHP_EOL; }

TARGETS := help install doctor serve build clean rebuild fmt fmt-check lint stan check dist clean-dist dist-serve version

HELP_help       := Show this help
HELP_install    := Install composer dependencies
HELP_doctor     := Print PHP / git / source status
HELP_serve      := Serve $(SRC)/ on http://$(HOST):$(PORT)
HELP_build      := Generate $(BUILD_OUT)
HELP_clean      := Remove $(BUILD_OUT)
HELP_rebuild    := clean + build
HELP_fmt        := Auto-format PHP source
HELP_fmt-check  := Check formatting without writing
HELP_lint       := Syntax check all PHP files
HELP_stan       := Static analysis (phpstan)
HELP_check      := Run fmt-check + lint + stan
HELP_dist       := Build minified $(DIST)/
HELP_clean-dist := Remove $(DIST)/
HELP_dist-serve := Build $(DIST)/ and serve it
HELP_version    := Print build version

.DEFAULT_GOAL := help
.PHONY: $(TARGETS) vendor-check

help:
	@$(PRINTF) 'Galonku\n\nUsage: make <target>\n\nTargets:\n'
	@$(foreach t,$(TARGETS),$(PRINTF) '  %-14s %s\n' '$(t)' '$(HELP_$(t))';)

vendor-check:
	@test -f $(AUTOLOAD) || { $(PRINTF) 'ERROR: run `make install` first\n'; exit 1; }

install:
	@$(COMP_INSTALL)

doctor:
	@$(PRINTF) 'PHP   : '; $(PHP) -v | $(HEAD) -n1
	@$(PRINTF) 'Git   : '; $(GIT) --version 2>/dev/null || $(PRINTF) 'not installed\n'
	@$(PRINTF) 'Source: '; test -d $(SRC) && $(PRINTF) 'ok\n' || $(PRINTF) 'missing\n'

serve:
	@$(PRINTF) 'Serving %s at http://%s:%s\n' "$(SRC)" "$(HOST)" "$(PORT)"
	@$(PHP_SERVE) $(SRC)

build:
	@$(PHP_BUILD)

clean:
	@$(RM) -f $(BUILD_OUT)
	@$(PRINTF) 'Removed %s\n' "$(BUILD_OUT)"

rebuild: clean build

fmt: vendor-check
	@$(CS_FIX)

fmt-check: vendor-check
	@$(CS_DRY)

lint:
	@$(LINT_LOOP)

stan: vendor-check
	@$(STAN_RUN)

check: fmt-check lint stan

dist: build vendor-check
	@$(PHP_DIST)

clean-dist:
	@$(RM) -rf $(DIST)
	@$(PRINTF) 'Removed %s\n' "$(DIST)"

dist-serve: dist
	@$(PRINTF) 'Serving %s at http://%s:%s\n' "$(DIST)" "$(HOST)" "$(PORT)"
	@$(PHP_SERVE) $(DIST)

version:
	@if [ -f $(BUILD_OUT) ]; then \
	  $(PHP_RUN) '$(VERSION_CMD)'; \
	else \
	  $(PRINTF) 'No build artifact (run `make build`)\n'; \
	fi

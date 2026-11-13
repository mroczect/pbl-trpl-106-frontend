
PHP       ?= php
HOST      ?= localhost
PORT      ?= 8000
SRC       ?= src
BUILD_SH  := build.php
BUILD_OUT := $(SRC)/build-info.php

.DEFAULT_GOAL := help

.PHONY: help serve build clean rebuild check version


serve:
	@printf 'Serving %s at http://%s:%s\n' "$(SRC)" "$(HOST)" "$(PORT)"
	@$(PHP) -S $(HOST):$(PORT) -t $(SRC)


build:
	@$(PHP) $(BUILD_SH)

clean:
	@rm -f $(BUILD_OUT)
	@printf 'Removed %s\n' "$(BUILD_OUT)"

rebuild: clean build


check:
	@printf 'PHP   : '; $(PHP) -v | head -n1
	@printf 'Git   : '; (git --version 2>/dev/null || echo 'not installed')
	@printf 'Source: '; [ -d "$(SRC)" ] && echo 'ok' || echo 'missing'

version:
	@if [ -f "$(BUILD_OUT)" ]; then \
		$(PHP) -r 'try { $$i = include "$(BUILD_OUT)"; echo ($$i["hash"] ?? "unknown"), PHP_EOL; } catch (Throwable $$e) { echo "invalid", PHP_EOL; }'; \
	else \
		printf 'No build artifact (run `make build`)\n'; \
	fi

help:
	@awk 'BEGIN { FS = ":.*##"; printf "Galonku\n\nTargets:\n" } \
		/^[a-zA-Z_-]+:.*##/ { sub(/^[ \t]+/, "", $$2); printf "  %-10s %s\n", $$1, $$2 }' \
		$(MAKEFILE_LIST)

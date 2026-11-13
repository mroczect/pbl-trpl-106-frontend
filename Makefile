# Makefile buat runing simpe aja ya

PHP = php 
FLAGS = -S
HOST = localhost

# ini port nya mau pakek 3000 3001 8432 seterah

PORT = 8000 

# ini pakek scr karna source code ny kn emg di src
SRC = src

serve:
	$(PHP) $(FLAGS) $(HOST):$(PORT) -t $(SRC)

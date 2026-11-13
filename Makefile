
PHP = php 
FLAGS = -S
HOST = localhost


PORT = 8000 

SRC = src

serve:
	$(PHP) $(FLAGS) $(HOST):$(PORT) -t $(SRC)

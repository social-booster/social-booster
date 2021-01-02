.PHONY:


help:
		cat Makefile

# docker
local:
		cp -p .env.local .env
		@make up

up:
		docker-compose up -d
upb:
		docker-compose up -d --build
down:
		docker-compose down
restart:
		@make down
		@make up

web:
		docker-compose exec web ash
app:
		docker-compose exec app bash

DOCKER_COMPOSE_COMMAND = docker-compose -p default -f docker-compose.yml

run:
	@${DOCKER_COMPOSE_COMMAND} up -d

stop:
	@${DOCKER_COMPOSE_COMMAND} stop

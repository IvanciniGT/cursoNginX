------------------------------------------------
NGINX1 Pagina WEB 1: index.html (Soy la pagina web 1 desde el servidor 1)
NGINX2 Pagina WEB 1: index.html (Soy la pagina web 1 desde el servidor 2)

------------
Para conseguir alta disponibilidad HA en un entorno de producción, crearía al menos 2 contenedores con la misma app.
Por delante tendría que montar un balanceador de carga
-----------------------
LO QUE ESTAMOS HACIENDO
-----------------------
1º Creando un fichero docker compose con los 2 contenedores definidos.
    Arranco ese fichero en una maquina unica
2º Montar un nginx como balanceador.
-------------------------------
LO QUE HARIAMOS EN LA REALIDAD
-------------------------------
1º Creando un fichero docker compose con 1 contenedor unico definido.
    Arranco ese fichero en 2 maquinas distintas
2º Montar un nginx como balanceador.
-------------------------------
LO QUE PODRIAMOS HACER EN LA REALIDAD
-------------------------------
1º Creando un fichero similar a los de docker compose con 1 contenedor unico definido.
    Mandar eso a Kubernetes
------------

Voy a montar mi NGINX que da la cara a los clientes finales:
    Proxy reverso
    Balanceador
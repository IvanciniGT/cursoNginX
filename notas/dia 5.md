Certificados y SSL
DDoS
Rendimiento (tunning) JMeter
Rotacion Logs

------------

HTTPS
    Man in the middle
    Phishing

Que neccesito en nginx para configurar ssl?
    SON CONFIGURACIONES QUE HACEMOS A NIVEL DE SERVER
    - Certificado                                   √
        - CA
        - Mi clave publica
    - Mi clave privada                              √
    - Escuchar por 443                              √
    - Activar que la escucha sea por https          √
    - Configurar parametros de ssl
        protocolo: TLSv1 TLSv1.1 TLSv1.2;           # TLSv1.3;   √
        ciphers:                                                 √
    - Redireccionar 80 > 443                        √        

Let's encrypt (90 dias)
    instalar un programa en mi server (NGINX) certbot
        una peticion al servidor de let's encrypt
            Quiero un certificado para este dominio (s)
    En mi server, tengo que tener un nginx (web server) que tenga abierto el puerto 80
    Y dentro de ese servidor una carpeta con un nombre especifico
        En esa carpeta se deja un fichero que recibe certbot al hacer la peticion
        El servidor de let's encrypt comprobueba que accediendo al dominio que solicito
            puede acceder a el fichero que ha mandado a certbot
    Si todo va bien, me entrega certificado + clave privada
    
    
Cliente      >>>>>        NGINX         >>>>>>      nextcloud
        Esto es lo de arriba                        Este es quien está sirviendo las peticiones
                                                    APACHE (certificado + clave privada)
                                                            Certificado del nextcloud, quien lo firma?
                                                                Son autofirmados: Yo me genero mi propia CA
                                                                     
                                                    Alfresco
                                                    
                            >>>     proxy_pass https://nexcloud
                                    proxy_ssl_trusted_certificate CERTIFICADO_DE_LA_CA_MIA; (publico)
                                    proxy_ssl_verify    on;   # off;   Encripcion si... suplantacion no. COMO SI NO LO HUBIERA CONTADO
                                       
                                       
Me genero una clave publica y una privada  ---> CA
    Con esa clave privada se va a firmar los certificados emitidos por la CA
        Incluido el de la propia CA
Genero un certificado para la CA: <<<<<<<<
    Quien soy (mi clave publica)
    Quien me avala (firma generada con la clave privada de la CA) que soy yo.


Me genero una clave publica y una privada  ---> para un servicio NEXTCLOUD
Genero un certificado para NEXTCLOUD:
    La clave publica de NEXTCLOUD
    Quien me avala (Certificado de la CA, firma con la clave privada de la CA)

-----------
NGINX
    Me pongo como loco a tirarle peticiones
    

CPU 90%   <
RAM 90%   <
RED 90%   <


Bueno o malo? IDEAL !!!

12000 peticiones por minuto

1500 usuarios 87 ms por peticion
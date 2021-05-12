Configuración:

Bloque inicial con configuración general

# Comentarios

Nombre_Directiva valor(es);

bloques_de_directivas1 {
    directivaA valor1;
    bloques_de_directivas2 {
        INCLUDE referencias_ficher_externo;        
    }   
    bloques_de_directivas2 {
        INCLUDE referencias_ficher_externo;        
    }   
    bloques_de_directivas2 {
        directivaA valor2;
        INCLUDE referencias_ficher_externo;        
    }   

    
}

INCLUDE referencias_ficher_externo;

---

Fragmentos de configuración que montamos en nginx en ficheros adicionales:
    available      disponibles  <<<< Ubicación real de los fragmentos de configuración
    enabled        activados    <<<< Enlaces simbñólicos a los ficheros/fragmentos que nos interesen
    
---- 
Sistema de control de versión para la gestión de los archivos yaml y conf

git < Linus Torwalds
    Github          << Microsoft lo ofrece como servicio Internet
    --------------------------------------------------------------
    Gitlab          SaaS , OnPremises  < Opensource
    Bitbucket       Jira (Atlassian)

Git funciona muy bien

-------------------------------
COMANDO nginx
    -c RUTA DEL ARCHIVO DE CONFIGURACION. Por defecto nginx busca el archivo /etc/nginx/nginx.conf
    -g "DIRECTIVAS"
    -s SIGNAL     EQUIVALENTE a ejecutar KILL SIGNAL 
        stop    Crujir nginx. Lo mato kill -9                                        TERM
        quit    Le digo que se pare pero con tranquilidad                            QUIT
        reload  Cargar cambios en el fichero de configuración en caliente            HUP
        reopen  Reabrir los ficheros de log (Rotación de los logs)                   USR1
    -t  Comprobación del fichero de configuración
    -T  Comprobación del fichero de configuración además devuelve el fichero
nginx como daemon:
    el programa lanza a su vez en segundo plano el nginx
pero el programa que lo ha lanzado termina con codigo 0

nginx como aplicacion:
    el programa se queda corriendo en primer plano
    
---------------------------------
DIRECTIVAS GLOBALES:
daemon              Se ejeute nginx en segundo plano o no.
worker_processes    Numero de ejecutores de conecxión que quiero montar en nginx
                    Establer el numero de CPUS que tengo en la máquina: Valor por defecto
                        Tiene sentido solo si mi maquina la dedico en exclusiva a nginx
                    DEPENDE DEL NUMERO DE CPUs
    worker_processes auto;
    worker_processes 2;
worker_connectios   Numero de peticiones SIMULTANEAS procesables por un worker de nginx
    worker_connectios 100;
    worker_connectios 512;
                    DEPENDE de la velocidad de las CPUs
                        Y DE LA RAM que tenbgo en la MAQUINA
---------------------------------
PROCESAMIENTO DE TRANSACCIONES EN nginx / ARQUITECTURA DE nginX
Ejecuta un proceso que se denomina master <<< Con su PID <<<< /run/nginx.pid
    Lee el fichero de configuración (y sus cambios) y configura workers, los arranca y se asegura que siguen ejecutandose.
Dentro de nginx quienen procesan las peticiones de usuarios son los WORKERS <<< PID
    Los workers van a abrir Threads (hilos): Tareas paralelas
    
--------------------------------
nginx en una máquina con 4 CPUs

ESCENARIO A: 1 nginx con 4 workers
    - Qué pasa si se cae nginx? Me quedo sin na' de na'

ESCENARIO B: 4 nginx con 1 worker
    - Qué pasa si se cae 1 nginx? Me queda 3
    - Problema que tengo aquí?
        A quien se conectan mis clientes?
            Que necesito delante de los nginx? Balanceador  <<<< Kubernetes / Openshift Container Platform (Redhat) vd Origin o OKD
        Dolores de cabeza en cuanto a configuración.

Docker swarm


------------
Kubernetes lo podeis montar en 1 unico ordenador con 4 cpus y 8 gbs de ram
    Cluster 4 x 50 nodos - clouds 

>>> Minikube
--------------


----------------------------
EXPRESIONES REGULARES PERL
----------------------------
URL: https://regex101.com/

Se basan en el concepto de PATRON.
PATRON es unas reglas que se pueden cumplir o no.

Las expresiones regular nos permiten hacer operaciones de tipo MATCH sobre un PATRON

OBJETIVO: Quiero ver si un texto cumple (match) un determinado PATRON

TEXTO: En un lugar de la Mancha en el año 2021 vívia un hidalgo CABALLERO.

PATRON: Tiene números                             SI
PATRON: Empieza por números                       NO
PATRON: tiene entre 2 y 6 números seguidos        SI

PATRON: GRUPO DE CARACTERES, a los que se aplica un FACTOR DE REPETICION:
            En un lugar     - literal
            [íóú]           - Uno de esos caracteres 
            [a-z]           - Uno de los caracteres entre la a y la z
            [a-zñáéíóúç]    - Uno de los caracteres entre la a y la z o la á é í ó ú ñ y ç
            [A-Za-z0-9]
            .               - Cualquier caracter. Ej: En un l.gar
            \s              - Cualquier caracter considera un blanco: ESPACIO, SALTO DE LINEA o UN TABULADOR
            
FACTOR DE REPETICION
            ?               - Opcional. El grupo de caracteres anterior puede aparecer o no
                                        En un (gran)? lugar de la Mancha
            *               - Opcional o infinito
            +               - Al menos 1 y a partir de ahí las que quiera
            {3}             - 3 veces tiene que aparecer
            {2,5}           - INTERVALO : De 2 a 5 veces
    
BARRA VERTICAL:
    |                       Se interpreta como un "O", sobre lo que haya alrededor
            a|b                 Que aparezca el caracter a o el b
                                    Equivalente a [ab]
            hola|adios      Que ponga hola o adios
            hola+|adios
            
INSTRUCCIONES ESPECIALES
            ^               Comienza por
            $               Acaba por
Parentesis :
    - Agrupar
    - Capturar trozos de texto
   
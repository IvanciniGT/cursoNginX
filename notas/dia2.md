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
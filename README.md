# MowerBots
Se trata de un ejemplo de uso de Symfony 5 con php8 y una estructura DDD, para resolver un problema de practica de empresa.
El ejercicio consiste en desarrollar un programa que permita gestionar el movimiento de unos robots cortacesped, con las 
siguientes condiciones:

  * se mueven en una matriz que se inicializa en la primera linea de orden. Por ej, si indicamos 10,8 esa matriz es de 10 filas
por 8 columnas.

  * En la segunda linea de orden, se indica la posición y la orientación del robot. Por ej, una orden 5,4,E indica que esta en la
posicion 5,4 y orientado hacia el Este.

  * el cortacesped robotico solo puede moverse hacia delante, o girar 90º a izquierda o derecha. Para ello, se utilizan las letras
(M)ove, (L)eft y (R)ight. los giros se realizan en la misma casilla en la que se encuentra cuando se interpreta la orden.
  * El cortacesped tiene una Posición inicial indicada en la segunda linea de orden. Ademas, se le indica una orientacion (N)orth,
(S)outh, (E)ast, (W)est, de manera que al interpretar la orden de (M)ove se despaza a la casilla de "avance" segun dicha orientacion.

Se incluye un docker-compose para poder probar directamente la aplicación. 

## Uso
La propuesta de solucion es un comando de consola de symfony, denominado `mower:process-file`. Este comando lee el archivo
que le indiquemos en la entrada y procesa las lineas, mostrando por pantalla la posición final de cada mower que se ha definido
en el archivo.

Para ejecutar el comando:
```
bin/console mower:process-file example.txt
```

el archivo de ejemplo `example.txt` contiene las siguientes instrucciones:

  * 5 5 define el tamaño de la malla de cesped.
  * 1 2 N es la posición y orientacion del primer robot
  * LMLMLMLMM es la secuencia de comandos que ejecuta el robot
  * 3 3 E es la posicion y orientacion del segundo robot
  * MMRMMRMRRM la secuencia de comandos que ejecuta el segundo robot.

la salida de la ejecución de la linea de comandos con este archivo es:
```
Procesando archivo example.txt
------------------
1 3 N
5 1 E
```

## Requisitos
- php 8.0 instalado en local
- Docker y Docker-compose
- composer

## Documentación
- [Changelog](docs/0_CHANGELOG.md)
- [DDD](docs/1_DDD.md)
- [Instalación](docs/2_INSTALACION.md)
- [Makefile](docs/3_MAKEFILE.md)

## decisiones iniciales
  * Inicialmente se asume que las ordenes de inicio del robot (posicion y orientacion), son SIEMPRE correctas, no esta posicionado
en unas coordenadas externas o erroneas fuera de la parcela de cesped.
  * Se asume tambien que la linea de ordenes genera unos movimientos correctos. Mas adelante analizaremos si en un momento el
robot se sale de la parcela o si efectua un movimiento no autorizado.
  * para simular la entrada de datos, vamos a generar un comando que se encargará de leer un archivo de ordenes. En dicho archivo
estará codificada la primera linea (que indica el tamaño de la parcela), asi como la posicion/orientacion inicial del robot y luego los
movimientos asociados. De salida por pantalla se indicará la posición final de cada uno de los robots
  * Puede darse el caso de que un robot "pase" por la posición donde hay otro robot? segun la secuencia de ejemplo no "existe" el
segundo robot, por lo que asumo que el robot secundario no existe, y no puede chocar con el primero tampoco.

## Lista TODO
- infraestructura de comando, asi como lectura de archivo de ordenes y su ejecucion.

## FIN
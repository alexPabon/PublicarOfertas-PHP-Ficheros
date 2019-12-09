<h1>Aplicacion web para publicar ofertas laborales y subir nuestro curriculum</h1>
<p>
	<b>PHP</b> dispone de una gran cantidad de funciones para realizar todo tipo de operaciones con ficheros y carpetas, desde las más básicas como crear ficheros y carpetas, modificar, eliminar, hasta otras más avanzadas para obtener y asignar permisos, crear enlaces simbólicos, etc.<br><br>
	Aquí veremos cómo realizar algunas de las tareas que más usualmente se realizan sobre ficheros y carpetas en PHP.<br><br>
	Al realizar operaciones con las funciones de ficheros y directorios es recomendable comprobar que se ha realizado de forma correcta. Por ejemplo, si necesitamos averiguar si existe un fichero o carpeta se puede utilizar la función file_exists(), que nos devolverá true si existe y false de lo contrario.
</p>

<h2> Abrir y cerrar ficheros</h2>
<p>
	<b>FOPEN</b><br>
	La función fopen(path, mode) permite abrir un fichero local o mediante un URL. 	
</p>
<ul>
	<li>El path del fichero debe incluir la ruta completa al mismo. </li>
	<li>El mode puede ser r - lectura, w - escritura, a - agregar, o x - escritura exclusiva.</li>
	<li>Se puede agregar un + al modo y si el fichero no existe, se intentará crear.</li>
</ul>
<p>
	<b>FCLOSE</b><br>
	La función fclose(file) cierra un puntero a un fichero abierto. Esto es, Una vez hayamos terminado de realizar las operaciones deseadas con el archivo es necesario cerrarlo usando la función fclose(), que escribirá en él los cambios pendientes en el buffer (memoria en la que se guardan los datos antes de ir escribiéndolos).<br><br>
	<b>Nota:</b><br>los sistemas Windows usan \r\n como caracteres de final de línea, los basados en UNIX usan \n y los sistemas basados en sistemas MACintosh usan \r <br><br>
	<b>FEOF</b><br>
	La función feof(file) comprueba si el puntero a un fichero se encuentra al final del fichero.<br><br>
	<b>FGETS</b><br>
	La función fgets(file) obtiene una línea desde el puntero a un fichero.<br><br>
	<b>FILE_EXISTS</b><br>
	La función file_exists(file) comprueba si existe un fichero o directorio.<br><br>
	<b>FSCANF</b><br>
	La función fscanf analiza la entrada desde un fichero de acuerdo a un formato. Los tipos más importantes son:
</p>
<h2>Cómo funciona la web.</h2>
<p>
	El objetivo de esta web es que las empresas puedan publicar sus ofertas de empleo y ver todas las personas que se han inscrito para cada oferta publicada, las personas podrán cargar toda la información personal y su experiencia laboral. Después de haber rellenado todos los datos, pueden inscribirse en todas las ofertas que quieran.
</p>
<p>
	Las empresas y los candidatos son fictiocios a modo de ejemplo para comprobar el funcionamiento de la aplicacion
</p>

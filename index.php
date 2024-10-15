<?php
// Increase the execution time limit to 300 seconds
ini_set('max_execution_time', 100000);
// Suponiendo que el Excel está en formato CSV (puedes adaptar para otros formatos)
$row = 1;
if (($handle = fopen("data.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);

        // Ruta completa donde se guardará el archivo en tu servidor
        $ruta_destino = "public/" . basename($data[0]); // Agregar nombre de archivo para evitar sobreescrituras

        // Obtener el contenido del archivo remoto
        $contenido = file_get_contents($data[0]);

        if ($contenido !== false) {
            // Crear el directorio si no existe
            if (!is_dir(dirname($ruta_destino))) {
                mkdir(dirname($ruta_destino), 0755, true);
            }

            // Guardar el contenido en el archivo local
            if (file_put_contents($ruta_destino, $contenido)) {
                echo "Archivo descargado y guardado correctamente en: " . $ruta_destino."<br>";
            } else {
                echo "Error al guardar el archivo: " . $ruta_destino;
            }
        } else {
            echo "Error al descargar el archivo: " . $data[0];
        }
        $row++;
    }
    fclose($handle);
}

?>
<?php 
include('app/header.php');

// Obtenemos los archivos .vcf de la carpeta actual y de otra carpeta especificada
$directory = '../'; // Cambia a '../' si los archivos están en un nivel más arriba
$otro_directorio = '../../'; // Especifica la otra carpeta donde buscar archivos VCF
$vcf_files = array_merge(glob($directory . "*.vcf"), glob($otro_directorio . "*.vcf"));
?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h3>Seleccionar Archivo VCF</h3>
            <p>Seleccione uno de los archivos VCF disponibles para visualizar su contenido y descargarlo si es necesario.</p>
        </div>
        
        <div class="card-body">
            <!-- Selector de archivos VCF -->
            <form method="POST">
                <label for="fileSelect">Archivos disponibles:</label>
                <select id="fileSelect" name="selectedFile" class="form-control">
                    <option value="">Seleccione un archivo...</option>
                    <?php foreach ($vcf_files as $file): ?>
                        <option value="<?php echo $file; ?>"><?php echo basename($file); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary mt-3">Ver contenido del Archivo</button>
            </form>
                       
            <!-- Tabla para mostrar el contenido del archivo VCF -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['selectedFile'])) {
                $filePath = $_POST['selectedFile'];

                if (file_exists($filePath)) {
                    echo "<h4>Contenido de: " . basename($filePath) . "</h4>";

                    // Parseo del archivo VCF
                    $fileContents = file($filePath);
                    $contacts = [];
                    $currentContact = [];

                    foreach ($fileContents as $line) {
                        $line = trim($line);
                        
                        // Comienza un nuevo contacto
                        if (strpos($line, 'BEGIN:VCARD') !== false) {
                            $currentContact = [];
                        } elseif (strpos($line, 'END:VCARD') !== false) {
                            // Fin del contacto actual
                            $contacts[] = $currentContact;
                        } else {
                            // Procesa los campos y valores
                            if (strpos($line, ':') !== false) {
                                list($field, $value) = explode(':', $line, 2);
                                $currentContact[$field] = $value;
                            }
                        }
                    }

                    // Mostrar en tabla
                    if (!empty($contacts)) {
                        // Crear encabezados de tabla dinámicamente
                        $headers = array_unique(array_merge(...array_map('array_keys', $contacts)));
                        echo ' <div style="max-height: 400px; overflow: scroll;"><table class="table table-striped">';
                        echo '<thead><tr>';
                        foreach ($headers as $header) {
                            echo "<th>$header</th>";
                        }
                        echo '</tr></thead>';
                        echo '<tbody>';
                        
                        // Crear filas de contactos
                        foreach ($contacts as $contact) {
                            echo '<tr>';
                            foreach ($headers as $header) {
                                echo '<td>' . (!empty($contact[$header]) ? $contact[$header] : '-') . '</td>';
                            }
                            echo '</tr>';
                        }

                        echo '</tbody></table></div>';
                        echo "<a href='$filePath' class='btn btn-success' download>Descargar " . basename($filePath) . "</a>";
                    } else {
                        echo "<p class='text-danger'>No se encontraron datos en el archivo seleccionado.</p>";
                    }
                } else {
                    echo "<p class='text-danger'>Archivo no encontrado.</p>";
                }
            }
            ?>
          
        </div>
    </div>
</section>

<?php include('app/footer.php'); ?>

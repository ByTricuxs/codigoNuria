<?php 
    require '../db.php'; // Incluye el archivo de conexión a la base de datos.

    if($_GET){ // Verifica si hay parámetros GET en la URL.
        $data = $database->select("tb_game_config","*",[ // Obtiene la configuración de juego basada en el id_game_config.
            "id_game_config"=> $_GET["id"]
        ]);
    }

    if($_POST){ // Verifica si hay datos enviados mediante POST.
        date_default_timezone_set('America/Costa_Rica'); // Establece la zona horaria.

        $database->update("tb_game_config",[ // Actualiza el registro en la base de datos.
            "game_data"=>$_POST['data'], // Almacena el valor de 'data' en la columna 'game_data'.
            "updated_at"=>date("Y-m-d H:i:s") // Actualiza el campo 'updated_at' con la fecha y hora actuales.
        ], ["id_game_config" => $_POST['id']]); // Filtra el registro a actualizar por el id_game_config enviado mediante POST.

        header("Location: ./index.php"); // Redirige a index.php una vez completada la actualización.
    }
?>

<!DOCTYPE html>

<html>

<head>
    <title>Syntax Highlightning for Textarea - adriancs
    </title>
    <link rel="icon" href="./favicon.ico" />
    <link rel="stylesheet" href="./css/style.css" />
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <!--Fonts-->
    <style id="styleFont" type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap');

        #preCode code,
        textarea,
        #lineNumbers,
        .lineNumbers {
            font-family: "Roboto Mono", monospace;
            font-weight: 400;
            font-size: 12pt;
            line-height: 150%;
        }
    </style>

    <style type="text/css">
        #divCodeWrapper {
            height: calc(100vh - 200px);
            max-height: 600px;
            width: 1200px;
            overflow: hidden;
            border: 1px solid #a5a5a5;
            position: relative;
        }

        #preCode {
            height: 100%;
            width: calc(100% - 50px);
            position: absolute;
            top: 0;
            left: 50px;
            overflow: hidden;
            padding: 0;
            margin: 0;
            background: #1b1b1b;
            border: none;
        }

        #preCode code {
            padding: 15px;
            height: calc(100% - 30px);
            width: calc(100% - 30px);
            overflow-y: scroll;
            overflow-x: auto;
        }

        textarea {
            position: absolute;
            top: 0;
            left: 50px;
            height: calc(100% - 30px);
            width: calc(100% - 80px);
            padding: 15px;
            z-index: 2;
            overflow-x: auto;
            overflow-y: scroll;
            white-space: nowrap;
            background-color: rgba(0, 0, 0, 0);
            color: rgba(0, 0, 0, 0);
            caret-color: white;
            border: none;
            outline: none;
            border-left: 1px solid #383838;
        }

        #lineNumbers {
            position: absolute;
            top: 0;
            left: 0;
            padding: 15px 5px;
            height: calc(100% - 50px);
            width: 100px;
            overflow: hidden;
        }
    </style>

    <link id="theme1" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/vs2015.min.css"
        rel="stylesheet" />

    <script src="codeEditorShortcutKeys.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"
        type="text/javascript"></script>

</head>

<body>

    <h1>JS Editor</h1>

    <p>
        Theme:
        <select id="selectStyle">
            <option>a11y-dark.min.css</option>
            <option>a11y-light.min.css</option>
            <option>agate.min.css</option>
            <option>an-old-hope.min.css</option>
            <option>androidstudio.min.css</option>
            <option>arduino-light.min.css</option>
            <option>arta.min.css</option>
            <option>ascetic.min.css</option>
            <option>atom-one-dark-reasonable.min.css</option>
            <option>atom-one-dark.min.css</option>
            <option>atom-one-light.min.css</option>
            <option>brown-paper.min.css</option>
            <option>codepen-embed.min.css</option>
            <option>color-brewer.min.css</option>
            <option>dark.min.css</option>
            <option>default.min.css</option>
            <option>devibeans.min.css</option>
            <option>docco.min.css</option>
            <option>far.min.css</option>
            <option>felipec.min.css</option>
            <option>foundation.min.css</option>
            <option>github-dark-dimmed.min.css</option>
            <option>github-dark.min.css</option>
            <option>github.min.css</option>
            <option>gml.min.css</option>
            <option>googlecode.min.css</option>
            <option>gradient-dark.min.css</option>
            <option>gradient-light.min.css</option>
            <option>grayscale.min.css</option>
            <option>hybrid.min.css</option>
            <option>idea.min.css</option>
            <option>intellij-light.min.css</option>
            <option>ir-black.min.css</option>
            <option>isbl-editor-dark.min.css</option>
            <option>isbl-editor-light.min.css</option>
            <option>kimbie-dark.min.css</option>
            <option>kimbie-light.min.css</option>
            <option>lightfair.min.css</option>
            <option>lioshi.min.css</option>
            <option>magula.min.css</option>
            <option>mono-blue.min.css</option>
            <option>monokai-sublime.min.css</option>
            <option>monokai.min.css</option>
            <option>night-owl.min.css</option>
            <option>nnfx-dark.min.css</option>
            <option>nnfx-light.min.css</option>
            <option>nord.min.css</option>
            <option>obsidian.min.css</option>
            <option>panda-syntax-dark.min.css</option>
            <option>panda-syntax-light.min.css</option>
            <option>paraiso-dark.min.css</option>
            <option>paraiso-light.min.css</option>
            <option>pojoaque.min.css</option>
            <option>purebasic.min.css</option>
            <option>qtcreator-dark.min.css</option>
            <option>qtcreator-light.min.css</option>
            <option>rainbow.min.css</option>
            <option>routeros.min.css</option>
            <option>school-book.min.css</option>
            <option>shades-of-purple.min.css</option>
            <option>srcery.min.css</option>
            <option>stackoverflow-dark.min.css</option>
            <option>stackoverflow-light.min.css</option>
            <option>sunburst.min.css</option>
            <option>tokyo-night-dark.min.css</option>
            <option>tokyo-night-light.min.css</option>
            <option>tomorrow-night-blue.min.css</option>
            <option>tomorrow-night-bright.min.css</option>
            <option>vs.min.css</option>
            <option selected>vs2015.min.css</option>
            <option>xcode.min.css</option>
            <option>xt256.min.css</option>
            <option>base16/3024.min.css</option>
            <option>base16/apathy.min.css</option>
            <option>base16/apprentice.min.css</option>
            <option>base16/ashes.min.css</option>
            <option>base16/atelier-cave-light.min.css</option>
            <option>base16/atelier-cave.min.css</option>
            <option>base16/atelier-dune-light.min.css</option>
            <option>base16/atelier-dune.min.css</option>
            <option>base16/atelier-estuary-light.min.css</option>
            <option>base16/atelier-estuary.min.css</option>
            <option>base16/atelier-forest-light.min.css</option>
            <option>base16/atelier-forest.min.css</option>
            <option>base16/atelier-heath-light.min.css</option>
            <option>base16/atelier-heath.min.css</option>
            <option>base16/atelier-lakeside-light.min.css</option>
            <option>base16/atelier-lakeside.min.css</option>
            <option>base16/atelier-plateau-light.min.css</option>
            <option>base16/atelier-plateau.min.css</option>
            <option>base16/atelier-savanna-light.min.css</option>
            <option>base16/atelier-savanna.min.css</option>
            <option>base16/atelier-seaside-light.min.css</option>
            <option>base16/atelier-seaside.min.css</option>
            <option>base16/atelier-sulphurpool-light.min.css</option>
            <option>base16/atelier-sulphurpool.min.css</option>
            <option>base16/atlas.min.css</option>
            <option>base16/bespin.min.css</option>
            <option>base16/black-metal-bathory.min.css</option>
            <option>base16/black-metal-burzum.min.css</option>
            <option>base16/black-metal-dark-funeral.min.css</option>
            <option>base16/black-metal-gorgoroth.min.css</option>
            <option>base16/black-metal-immortal.min.css</option>
            <option>base16/black-metal-khold.min.css</option>
            <option>base16/black-metal-marduk.min.css</option>
            <option>base16/black-metal-mayhem.min.css</option>
            <option>base16/black-metal-nile.min.css</option>
            <option>base16/black-metal-venom.min.css</option>
            <option>base16/black-metal.min.css</option>
            <option>base16/brewer.min.css</option>
            <option>base16/bright.min.css</option>
            <option>base16/brogrammer.min.css</option>
            <option>base16/brush-trees-dark.min.css</option>
            <option>base16/brush-trees.min.css</option>
            <option>base16/chalk.min.css</option>
            <option>base16/circus.min.css</option>
            <option>base16/classic-dark.min.css</option>
            <option>base16/classic-light.min.css</option>
            <option>base16/codeschool.min.css</option>
            <option>base16/colors.min.css</option>
            <option>base16/cupcake.min.css</option>
            <option>base16/cupertino.min.css</option>
            <option>base16/danqing.min.css</option>
            <option>base16/darcula.min.css</option>
            <option>base16/dark-violet.min.css</option>
            <option>base16/darkmoss.min.css</option>
            <option>base16/darktooth.min.css</option>
            <option>base16/decaf.min.css</option>
            <option>base16/default-dark.min.css</option>
            <option>base16/default-light.min.css</option>
            <option>base16/dirtysea.min.css</option>
            <option>base16/dracula.min.css</option>
            <option>base16/edge-dark.min.css</option>
            <option>base16/edge-light.min.css</option>
            <option>base16/eighties.min.css</option>
            <option>base16/embers.min.css</option>
            <option>base16/equilibrium-dark.min.css</option>
            <option>base16/equilibrium-gray-dark.min.css</option>
            <option>base16/equilibrium-gray-light.min.css</option>
            <option>base16/equilibrium-light.min.css</option>
            <option>base16/espresso.min.css</option>
            <option>base16/eva-dim.min.css</option>
            <option>base16/eva.min.css</option>
            <option>base16/flat.min.css</option>
            <option>base16/framer.min.css</option>
            <option>base16/fruit-soda.min.css</option>
            <option>base16/gigavolt.min.css</option>
            <option>base16/github.min.css</option>
            <option>base16/google-dark.min.css</option>
            <option>base16/google-light.min.css</option>
            <option>base16/grayscale-dark.min.css</option>
            <option>base16/grayscale-light.min.css</option>
            <option>base16/green-screen.min.css</option>
            <option>base16/gruvbox-dark-hard.min.css</option>
            <option>base16/gruvbox-dark-medium.min.css</option>
            <option>base16/gruvbox-dark-pale.min.css</option>
            <option>base16/gruvbox-dark-soft.min.css</option>
            <option>base16/gruvbox-light-hard.min.css</option>
            <option>base16/gruvbox-light-medium.min.css</option>
            <option>base16/gruvbox-light-soft.min.css</option>
            <option>base16/hardcore.min.css</option>
            <option>base16/harmonic16-dark.min.css</option>
            <option>base16/harmonic16-light.min.css</option>
            <option>base16/heetch-dark.min.css</option>
            <option>base16/heetch-light.min.css</option>
            <option>base16/helios.min.css</option>
            <option>base16/hopscotch.min.css</option>
            <option>base16/horizon-dark.min.css</option>
            <option>base16/horizon-light.min.css</option>
            <option>base16/humanoid-dark.min.css</option>
            <option>base16/humanoid-light.min.css</option>
            <option>base16/ia-dark.min.css</option>
            <option>base16/ia-light.min.css</option>
            <option>base16/icy-dark.min.css</option>
            <option>base16/ir-black.min.css</option>
            <option>base16/isotope.min.css</option>
            <option>base16/kimber.min.css</option>
            <option>base16/london-tube.min.css</option>
            <option>base16/macintosh.min.css</option>
            <option>base16/marrakesh.min.css</option>
            <option>base16/materia.min.css</option>
            <option>base16/material-darker.min.css</option>
            <option>base16/material-lighter.min.css</option>
            <option>base16/material-palenight.min.css</option>
            <option>base16/material-vivid.min.css</option>
            <option>base16/material.min.css</option>
            <option>base16/mellow-purple.min.css</option>
            <option>base16/mexico-light.min.css</option>
            <option>base16/mocha.min.css</option>
            <option>base16/monokai.min.css</option>
            <option>base16/nebula.min.css</option>
            <option>base16/nord.min.css</option>
            <option>base16/nova.min.css</option>
            <option>base16/ocean.min.css</option>
            <option>base16/oceanicnext.min.css</option>
            <option>base16/one-light.min.css</option>
            <option>base16/onedark.min.css</option>
            <option>base16/outrun-dark.min.css</option>
            <option>base16/papercolor-dark.min.css</option>
            <option>base16/papercolor-light.min.css</option>
            <option>base16/paraiso.min.css</option>
            <option>base16/pasque.min.css</option>
            <option>base16/phd.min.css</option>
            <option>base16/pico.min.css</option>
            <option>base16/pop.min.css</option>
            <option>base16/porple.min.css</option>
            <option>base16/qualia.min.css</option>
            <option>base16/railscasts.min.css</option>
            <option>base16/rebecca.min.css</option>
            <option>base16/ros-pine-dawn.min.css</option>
            <option>base16/ros-pine-moon.min.css</option>
            <option>base16/ros-pine.min.css</option>
            <option>base16/sagelight.min.css</option>
            <option>base16/sandcastle.min.css</option>
            <option>base16/seti-ui.min.css</option>
            <option>base16/shapeshifter.min.css</option>
            <option>base16/silk-dark.min.css</option>
            <option>base16/silk-light.min.css</option>
            <option>base16/snazzy.min.css</option>
            <option>base16/solar-flare-light.min.css</option>
            <option>base16/solar-flare.min.css</option>
            <option>base16/solarized-dark.min.css</option>
            <option>base16/solarized-light.min.css</option>
            <option>base16/spacemacs.min.css</option>
            <option>base16/summercamp.min.css</option>
            <option>base16/summerfruit-dark.min.css</option>
            <option>base16/summerfruit-light.min.css</option>
            <option>base16/synth-midnight-terminal-dark.min.css</option>
            <option>base16/synth-midnight-terminal-light.min.css</option>
            <option>base16/tango.min.css</option>
            <option>base16/tender.min.css</option>
            <option>base16/tomorrow-night.min.css</option>
            <option>base16/tomorrow.min.css</option>
            <option>base16/twilight.min.css</option>
            <option>base16/unikitty-dark.min.css</option>
            <option>base16/unikitty-light.min.css</option>
            <option>base16/vulcan.min.css</option>
            <option>base16/windows-10-light.min.css</option>
            <option>base16/windows-10.min.css</option>
            <option>base16/windows-95-light.min.css</option>
            <option>base16/windows-95.min.css</option>
            <option>base16/windows-high-contrast-light.min.css</option>
            <option>base16/windows-high-contrast.min.css</option>
            <option>base16/windows-nt-light.min.css</option>
            <option>base16/windows-nt.min.css</option>
            <option>base16/woodland.min.css</option>
            <option>base16/xcode-dusk.min.css</option>
            <option>base16/zenburn.min.css</option>
        </select>
        Font:
        <select id="selectFont">
            <option>Roboto Mono</option>
            <option>Consolas</option>
            <option>Cascadia Mono</option>
            <option>Inconsolata</option>
            <option>Source Code Pro</option>
            <option>IBM Plex Mono</option>
            <option>Space Mono</option>
            <option>PT Mono</option>
            <option>Ubuntu Mono</option>
            <option>Nanum Gothic Coding</option>
            <option>Cousine</option>
            <option>Fira Mono</option>
            <option>Share Tech Mono</option>
            <option>Courier Prime</option>
            <option>Anonymous Pro</option>
            <option>Cutive Mono</option>
            <option>VT323</option>
            <option>JetBrains Mono</option>
            <option>Noto Sans Mono</option>
            <option>Red Hat Mono</option>
            <option>Martian Mono</option>
            <option>Major Mono Display</option>
            <option>Nova Mono</option>
            <option>Syne Mono</option>
            <option>Xanh Mono</option>
            <option>Monofett</option>
        </select>
        Font Size (pt):
        <input id="inputFontSize" type="number" step=".1" value="12" style="width: 40px;" />
        Language:
        <select id="selectLanguage">
            <option value="language-html">HTML</option>
            <option value="language-javascript">JavaScript</option>
            <option value="language-python">Python</option>
            <option value="language-java">Java</option>
            <option value="language-csharp">C#</option>
            <option value="language-php">PHP</option>
            <option value="language-cpp">C++</option>
            <option value="language-typescript">TypeScript</option>
            <option value="language-ruby">Ruby</option>
            <option value="language-swift">Swift</option>
            <option value="language-kotlin">Kotlin</option>
        </select>
        Line Height (%):
        <input id="lineHeight" type="number" value="150" style="width: 50px;" />
    </p>


    <!-- Textarea, the code editor -->

    <div id="divCodeWrapper">
    <pre><code style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" class="lineNumbers"></code></pre>
    <pre><code id="lineNumbers" style="opacity: 0.5;"></code></pre>
    <pre id="preCode"><code id="codeBlock" class="language-html"></code></pre>
    <form action="./edit.php" method="POST"> // Formulario que envía datos a edit.php mediante el método POST.
        <textarea id="textarea1" wrap="soft" spellcheck="false" name="data" style="color: white;">
            <?php 
                echo $data[0]["game_data"]; // Muestra el contenido actual de game_data en el campo de texto para que pueda editarse.
            ?>
        </textarea>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"> // Campo oculto que contiene el id del registro a actualizar.
        <input type="submit" value="Submit data" style="display:block; position: absolute; with: 15%; bottom: 15px; background: #a5a5a5; 
        color: #1b1b1b; font-size: 18px; text-align: center; height: 30px; z-index: 10; right: 40px;"> // Botón para enviar los datos actualizados.
    </form>
</div>

    <!-- End of the code editor -->

    <script type="text/javascript">

        const textarea1 = document.getElementById("textarea1");
        const codeBlock = document.getElementById("codeBlock");
        const lineNumbers = document.getElementById('lineNumbers');

        function updateLineNumbers() {
            let lineCount = textarea1.value.split('\n').length;
            let lines = '';
            for (let i = 1; i <= lineCount; i++) {
                lines += i + '\n';
            }
            lineNumbers.innerHTML = lines;
        }

        // copy code from textarea to code block
        function updateCode() {

            let content = textarea1.value;

            // encode the special characters 
            content = content.replace(/&/g, '&amp;');
            content = content.replace(/</g, '&lt;');
            content = content.replace(/>/g, '&gt;');

            // fill the encoded text to the code
            codeBlock.innerHTML = content;
            updateLineNumbers();

            // call highlight.js to render the syntax highligtning
            highlightJS();
        }

        // syntax highlight
        function highlightJS() {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        }

        // detect content changes in the textarea
        textarea1.addEventListener("input", () => {
            updateCode();
        });

        // sync the scroll bar position between textarea and code block
        textarea1.addEventListener("scroll", () => {
            codeBlock.scrollTop = textarea1.scrollTop;
            codeBlock.scrollLeft = textarea1.scrollLeft;
            lineNumbers.scrollTop = textarea1.scrollTop;
        });



        // change theme
        document.getElementById("selectStyle").addEventListener("change", (e) => {
            document.getElementById("theme1").href = `https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/${e.target.value}`;
        });

        // change font
        function updateFont() {
            let selectFont = document.getElementById("selectFont");
            let fontName = selectFont.options[selectFont.selectedIndex].text;
            let fontNameUrl = fontName.replace(" ", "+");
            let inputFontSize = document.getElementById("inputFontSize");
            let lineHeight = document.getElementById("lineHeight");

            document.getElementById("styleFont").textContent = `
            @import url('https://fonts.googleapis.com/css2?&display=swap&family=${fontNameUrl}');
            pre, code, textarea, #lineNumbers, .lineNumbers {
                font-family: "${fontName}", monospace;
                font-size: ${inputFontSize.value}pt;
                line-height: ${lineHeight.value}%;
            }`;
        }

        // change programming language
        document.getElementById("selectLanguage").addEventListener("change", function () {
            document.getElementById("codeBlock").className = this.value;
            highlightJS();
        });

        // change font size
        document.getElementById("inputFontSize").addEventListener("input", () => { updateFont(); });

        // change font
        document.getElementById("selectFont").addEventListener("change", () => { updateFont(); });

        // change line height
        document.getElementById("lineHeight").addEventListener("input", () => { updateFont(); });

        // load sample html
        function loadSampleHtml() {

        }

        bindCodeEditorShortcutKeys(textarea1);

        // wait for all files (css, js) finished laoding
        window.onload = function () {

            // use a timer to delay the execution
            // (highlight.js require some time to be ready)
            setTimeout(loadSampleHtml, 250);
        };

    </script>
</body>

</html>
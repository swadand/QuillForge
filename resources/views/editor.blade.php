<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Material Dashboard 2 by Creative Tim
    </title>
    @include('common.editor-header')
    <!-- Include Quill stylesheet -->
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/vtnpmaltqyvl285ga58cvk7pu11zjc6h6nl477p992d28igp/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            height: "90vh",
            promotion: false
        });
    </script>

    {{-- <style>
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        main {
            height: 100%;
        }

        #editor-container {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .ql-container {
            z-index: 1;
            background-color: white;
            margin: auto;
            width: 800px;
            padding: 10px 60px 0;
            overflow-y: visible;
        }

        .ql-editor {
            color: #000000;
            overflow-y: hidden;
        }

        .ql-toolbar,
        #header {
            z-index: 600;
            position: sticky !important;
            top: 0;
            background-color: rgb(247, 247, 247);
            width: 100%;
            margin: 0;
        }

        /* .page {
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: rgb(255, 255, 255);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        } */

        .page {
            min-width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: rgb(255, 255, 255);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }



        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            #header {
                display: none;
            }

            #editor-container {
                background-color: white !important;
            }

            .page {
                display: block;
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

            .page:last-child {
                page-break-after: auto !important;
            }
        }
    </style> --}}
</head>

<body class="g-sidenav-show  bg-gray-200">
    <main class="main-content position-relative border-radius-lg ">

        {{-- Toolbar --}}
        <div id="header">
            @include('common.editor-navbar')
            {{-- <div id="toolbar-container">
                <span class="ql-formats">
                    <select class="ql-font"></select>
                    <select class="ql-size"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-strike"></button>
                </span>
                <span class="ql-formats">
                    <select class="ql-color"></select>
                    <select class="ql-background"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-script" value="sub"></button>
                    <button class="ql-script" value="super"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-header" value="1"></button>
                    <button class="ql-header" value="2"></button>
                    <button class="ql-blockquote"></button>
                    <button class="ql-code-block"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-list" value="ordered"></button>
                    <button class="ql-list" value="bullet"></button>
                    <button class="ql-indent" value="-1"></button>
                    <button class="ql-indent" value="+1"></button>
                    <select class="ql-align"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-link"></button>
                    <button class="ql-image"></button>
                    <button class="ql-video"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-clean"></button>
                    <button id="export-pdf"><i class="fa-regular fa-file-pdf"></i></button>
                </span>
            </div> --}}
        </div>

        {{-- Editor --}}
        <div id="editor-container" class="container-fluid d-inline-block bg-gray-300">
            <div id="editor" class="page">
                <div class="subpage">
                </div>
            </div>
        </div>
    </main>

    @include('common.editor-footer')

</body>
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    /* var editors = [];
    var pages = 0;
    editors[0] = new Quill(`#e-${pages}`, {
        modules: {
            toolbar: "#toolbar-container",
        },
        theme: 'snow',
    }); */
    $(document).ready(function() {
        setTimeout(() => {
            console.log("called");
            $(".tox-statusbar").hide();
        }, 300);
    });


    const downloadpdf = () => {
        window.print();
    };
    document.getElementById('export-pdf').addEventListener('click', downloadpdf);

    /* $(document).on("keydown", ".ql-editor", function() {
        if ($(this)[0].scrollHeight > 969) {
            var el = $(this).parent().attr('id');
            idx = el.split("-")[1];

            if(editors[idx+1] != undefined) {
                editors[idx+1].focus();
            }

            var subpage = document.createElement("div");
            subpage.classList.add("subpage");
            var page = document.createElement("div");
            page.classList.add("page");
            page.setAttribute("id", `e-${++pages}`);
            page.appendChild(subpage);

            $("#editor-container").append(page);

            editors[pages] = new Quill(`#e-${pages}`, {
                modules: {
                    toolbar: "#toolbar-container",
                },
                theme: 'snow'
            });


            el = editors[++idx];
            el.focus();
        }

    }) */
    /* 
        $(window).bind('keydown', function(event) {
            if (event.ctrlKey || event.metaKey) {
                switch (String.fromCharCode(event.which).toLowerCase()) {
                    case 's':
                        event.preventDefault();
                        save_text();
                        break;
                }
            }
        });

        function save_text() {
            var content = "";
            editors.forEach(e => {
                content += e.root.innerHTML;
            });

            console.log(content);
        } */
</script>

</html>

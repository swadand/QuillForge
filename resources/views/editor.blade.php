<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <script src="{{ url('assets/js/jquery.js') }}"></script>
    <title>
        Material Dashboard 2 by Creative Tim
    </title>
    @include('common.editor-header')
    <!-- Include Quill stylesheet -->
    <script src="https://cdn.tiny.cloud/1/pas8hdp7rn56kf713gkg51wuo1yhjj31yv6g5xlg0qxfr78a/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#premiumskinsandicons-fabric',
            skin: 'fabric',
            content_css: [
                'fabric',
                '//www.tiny.cloud/css/codepen.min.css'
            ],
            toolbar_mode: 'floating',
            plugins: 'advlist anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars wordcount',
            toolbar: 'undo redo | formatselect | bold italic strikethrough forecolor backcolor blockquote | link image media | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat',
            height: '92vh',
            @if ($owned_by != session('user_id'))
                  noneditable_class: 'my-custom-editor-container',
            @elseif ($status == 0 || $status == 2)
                  noneditable_class: 'my-custom-editor-container',
            @endif
            setup: function(editor) {
                //Tastenkombinationen
                editor.on('keydown', function(e, evt) {
                    if (e.keyCode == 9) {
                        e.preventDefault();
                        editor.insertContent('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')
                    }
                });

                function save_text() {
                    var content = "";
                    content = tinymce.activeEditor.getContent("myTextarea");
                    let token = '@csrf';
                    token = token.substr(42, 40);

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/save/book') }}",
                        data: {
                            //_method: 'PUT',
                            "_token": token,
                            "content": content,
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.statusCode == '200') {
                                console.log(response);
                            } else {
                                console.log(response.msg);
                            }
                        },
                        error: function(err) {
                            response = JSON.parse(err.responseText);

                            console.log(err.responseText);
                        }
                    });
                    console.log(content);
                }

                editor.on('keydown', function(e, evt) {
                    if (event.ctrlKey || event.metaKey) {
                        switch (String.fromCharCode(event.which).toLowerCase()) {
                            case 's':
                                event.preventDefault();
                                save_text();
                                break;
                        }
                    }
                });
            }
        });
    </script>

    <style>
        /* Add a border around the editor */
        .my-custom-editor-container {
            border: 1px solid #CBCBCB;
            border-top: 0;
            height: 80vh;
            /* Remove top border because of the dummy header */
        }

        .dummy-header {
            background-color: #2b579a;
            color: #fff;
            display: flex;
            font-size: 20px;
            line-height: 50px;
            padding: 0 1rem;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <main class="main-content position-relative border-radius-lg ">

        {{-- Toolbar --}}
        <div id="header">
            @include('common.editor-navbar')
        </div>

        {{-- Editor --}}
        <div id="editor-container" class="container-fluid d-inline-block bg-gray-300">
            <div class="my-custom-editor-container">
                <textarea id="premiumskinsandicons-fabric">
                    @isset($content)
{{ $content }}
@endisset
                </textarea>
            </div>
        </div>
    </main>

    @include('common.editor-footer')

</body>
<!-- Include the Quill library -->

<!-- Initialize Quill editor -->
<script>
    $(document).ready(function() {
        setTimeout(() => {
            console.log("called");
            $(".tox-statusbar__branding").hide();
            $(".tox-statusbar__path").hide();
        }, 800);

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
            content = tinymce.activeEditor.getContent("myTextarea");
            let token = '@csrf';
            token = token.substr(42, 40);

            $.ajax({
                type: "POST",
                url: "{{ url('/save/book') }}",
                data: {
                    //_method: 'PUT',
                    "_token": token,
                    "content": content,
                },
                dataType: "json",
                success: function(response) {

                    if (response.statusCode == '200') {
                        console.log(response);
                    } else {
                        console.log(response.msg);
                    }
                },
                error: function(err) {
                    response = JSON.parse(err.responseText);

                    console.log(err.responseText);
                }
            });
            console.log(content);
        }

        $('#save-button').on('click', function() {
            save_text();
        });
    });
</script>

</html>

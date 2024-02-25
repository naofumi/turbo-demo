<head>
    <meta charset="UTF-8">
    <title>Turbo demo</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../vendor/bootstrap-5.3.3-dist/css/bootstrap.css"/>
    <script src="../js/turbo.js" data-turbo-track="reload"></script>
    <script src="../js/utilities.js" data-turbo-track="reload"></script>
    <script src="../vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.js" data-turbo-track="reload"></script>
    <script type="module">
      import { Application, Controller } from "../js/stimulus.js"
      window.Stimulus = Application.start()

      Stimulus.register("modal", class extends Controller {
        connect() {
          // this.modal = this.element
          this.modal = new bootstrap.Modal(this.element)
          this.modal.show()
        }
      })
    </script>

    <!--    <meta name="turbo-cache-control" content="no-preview">-->
    <!--    <meta name="turbo-cache-control" content="no-cache">-->
    <!-- 動作の再現性を高めるため -->
    <meta name="turbo-prefetch" content="false">

    <style>
        turbo-frame#edit-modal[busy] {
            > * {
                display: none;
            }

            &::before {
                content: url('../img/Settings.gif');
                margin: 40px auto;
                width: 100px;
                display: block;
            }
        }
    </style>
</head>

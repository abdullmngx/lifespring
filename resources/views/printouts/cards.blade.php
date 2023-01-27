<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    table 
    {
        width: 100%;
    }
    th, td {
        font-size: 13.5px;
    }
    .borderless
    {
        border: none;
    }
    main {
        background: url("./logobg.jpg") fixed;
        opacity: 0.3;
        background-position: center;
        background-repeat: no-repeat;
    }
    .foot
    {
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
    .page-break {
        page-break-after: always;
    }
</style>
</head>

<body>
@foreach($cards as $card)
  <header>
    <div>
        <table class="borderless" border="0" style="border: 0">
            <tr style="border: 0">
                <th width="10%" style="border: 0">
                    <img src="{{ url('/logo.jpg') }}" width="110" alt="logo">
                </th>
                <th style="border: 0" width="90%">
                    <span style="text-transform: uppercase; font-size: 80px; margin: 0px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif"><span style="color: orangered">L</span><span style="color: blue">I</span><span style="color: orange">F</span><span>E</span> <span style="color: limegreen">S</span><span style="color: orange">P</span><span style="color: purple">R</span><span style="color: aqua">I</span><span style="color: violet">N</span><span>G</span></span>
                </th>
            </tr>
        </table>
        <table border="0" style="border: 0; text-align:center">
            <tr style="border: 0; text-align:center">
                <th style="border: 0; text-align:center" width="90%"><h4 style="text-transform: uppercase; margin: 1px;">Early Child Care Centre (ECCC), Primary & Secondary School, Minna</h4></th>
            </tr>
            <tr style="border: 0; text-align:center">
                <th style="border: 0; text-align:center" width="90%"><p>No. J2B Ibrahim Aliyu Road P.O. Box 3232 Dutsen-Kura Minna, Niger State</p></th>
            </tr>
        </table>
    </div>
  </header>
  <main style="margin-top: 40px;">
    <table cellpadding="5">
        <tr style="text-transform: uppercase">
            <td>Card Pin</td>
            <td>{{ $card->pin }}</td>
        </tr>
        <tr style="text-transform: uppercase">
            <td>Card Serial</td>
            <td>{{ $card->serial }}</td>
        </tr>
    </table>
  </main>
  <footer style="margin-top:40px;">
    <p class="foot text-center" style="color: orange;"><i>...Brain & Mind Development</i></p>
  </footer>
@endforeach
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
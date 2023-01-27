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
        border: 0;
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
</style>
</head>

<body>
  <header>
    <div style="">
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
                <th rowspan="3" width="10%" style="border: 0"><img src="{{ url('/storage/'.$student->passport) }}" width="80" height="100" alt=""></th>
            </tr>
            <tr style="border: 0; text-align:center">
                <th style="border: 0; text-align:center" width="90%"><p>No. J2B Ibrahim Aliyu Road P.O. Box 3232 Dutsen-Kura Minna, Niger State</p></th>
            </tr>
            <tr style="border: 0; text-align:center">
                <th style="border: 0; text-align:center" width="90%"><span style="background-color: purple; padding: 7px; color: white; border-radius: 25px; font-size: 18px; font-weight: bolder;">{{ strtoupper($student->section) }} END OF TERM REPORT</span></th>
            </tr>
        </table>
    </div>
  </header>
  <main style="margin-top: 40px;">
    <table cellpadding="5">
        <tr style="text-transform: uppercase">
            <td>NAME: {{ $student->full_name }}</td>
            <td>TOTAL IN CLASS: {{$student->class_total}}</td>
        </tr>
        <tr style="text-transform: uppercase">
            <td>ADMISSION NUMber: {{ $student->admission_number }}</td>
            <td>Overall total: {{ $student->results->first()?->overall_score}} </td>
        </tr>
        <tr style="text-transform: uppercase">
            <td>term: {{ $meta['term'] }}</td>
            <td>No of times sch. opened: {{ $student->present_count + $student->absent_count }}</td>
        </tr>
        <tr style="text-transform: uppercase">
            <td>class: {{ $student->form }}{{ $student->arm }} </td>
            <td>no. of times present: {{ $student->present_count }}</td>
        </tr>
        <tr style="text-transform: uppercase">
            <td>next term begins:</td>
            <td>no. of times absent: {{ $student->absent_count }}</td>
        </tr>
    </table>

    <table style="margin-top: 40px;" cellpadding="5">
        <thead style="text-align: center">
            <tr>
                <th rowspan="2">
                    Subjects
                </th>
                <th colspan="3">
                    Continous<br>Assessment
                </th>
                <th rowspan="2" style="background-color: purple; color: white;">EXAM</th>
                <th rowspan="2" style="background-color: orange; color: white;">TOTAL</th>
                <th rowspan="2" style="background-color: blue; color: white;">AVERAGE</th>
                <th rowspan="2" style="background-color: red; color: white;">GRADE</th>
                <th rowspan="2" style="background-color: green; color: white;">REMARK</th>
            </tr>
            <tr>
                <th style="background-color: rgb(235, 129, 8); color: white;">1ST PT</th>
                <th style="background-color: rgb(235, 129, 8); color: white;">2ND PT</th>
                <th style="background-color: rgb(235, 129, 8); color: white;">MTT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->results as $result)
                <tr>
                    <td>{{ $result->subject }}</td>
                    <td>{{ $result->ca1_score }}</td>
                    <td>{{ $result->ca2_score }}</td>
                    <td>{{ $result->ca3_score }}</td>
                    <td>{{ $result->exam_score }}</td>
                    <td>{{ $result->total_score }}</td>
                    <td>{{$result->average}}</td>
                    <td>{{ $result->grade }}</td>
                    <td>{{ $result->grade_remark }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </main>
  <footer style="margin-top:40px;">
    <table class="borderless" style="margin-bottom: 20px;" cellpadding="5">
        <tr>
            <td colspan="2">Teacher's Remark: <span style="">{{ $student->results->first()?->teachers_remark }}</span></td>
        </tr>
        <tr>
            <td>Sign:</td>
            <td>Date:</td>
        </tr>
    </table>
    <table class="borderless" cellpadding="5">
        <tr>
            <td colspan="2">Center Manager's Remark: <span style="">{{ $student->results->first()?->managers_remark }}</span></td>
        </tr>
        <tr>
            <td>Sign:</td>
            <td>Date:</td>
        </tr>
    </table>
    <p class="foot text-center" style="color: orange;"><i>...Brain & Mind Development</i></p>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
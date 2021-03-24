<!DOCTYPE html>
<html>
  <head>
    <style>
      table{
            min-width: 700px;
            /*margin: auto;*/
            margin-top: 30px;
      }
      #file-image{
        height: 150px;
        width: 150px;
      }
    </style>
    <meta charset="utf-8">
    <title>Equipo Health</title>
  </head>
  <body>
    <?php global $myvar; ?>
    <!-- <span data-href="/export" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span> -->
    <a style="float:right;" id="export" onclick="exportTasks(event.target)" href="{{ url('export') }}" target="_blank">Export</a> 
    <table class="table table-bordered" cellpadding = "10" cellspacing = "10">
    <caption><b>Previous Consultations</b></caption>
      <tr>
        <th style="visibility:collapse;">Rid</th>
        <th>Clinic Name</th>
        <th>Clinic Logo</th>
        <th>Physician Name</th>
        <th>Physician Contact</th>
        <th>Patient First Name</th>
        <th>Patient Last Name</th>
        <th>Patient DOB</th>
        <th>Patient Contact</th>
        <th>Complaint</th>
        <th>Consultation</th>
        <th>Download</th>
      </tr>
      @foreach ($posts as $key => $value)
      <tr>
        @foreach ($value as $keyy => $valuee)
        @if($keyy == 'PDOB')
        <td>
          {{ \Carbon\Carbon::parse($valuee)->format('d/m/Y')}}
        </td>
        @elseif($keyy == 'Rid')
        <td style="visibility:collapse;">
          {{ $valuee }}
          <?php $myvar = $valuee; ?>
        </td>
        @elseif($keyy == 'Logo')
        <td>
          <img id="file-image" src="/logo/{{ $valuee }}" alt="Image"/>
        </td>
        @else
        <td>
          {{ $valuee }}
        </td>
        @endif
        @endforeach
        <td><a href="{{ url('download', [$myvar]) }}" target="_blank">Download</a></td>
      </tr>
      @endforeach
    </table>
  </body>
  <script type="text/javascript">
    function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
  </script>
</html>
<!-- "{{url('/logo/',[$valuee])}}" -->
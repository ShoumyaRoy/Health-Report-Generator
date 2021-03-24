<!DOCTYPE html>
<html>
  <head>
    <style>
div.header {
    display: flex; text-align: center; align-items: center; justify-content: space-between;
    position: running(header);
}
div.footer {
    display: flex; text-align: center; align-items: center; justify-content: space-between;
    position: fixed; bottom: 0;
}
table{
      min-width: 700px;
      margin: auto;
      margin-top: 30px;
}
#file-image{
  height: 150px;
  width: 150px;
}
@page {
    @top-center { content: element(header) }
}
@page { 
    @bottom-center { content: element(footer) }
}
</style>
    <meta charset="utf-8">
    <title>Equipo Health</title>
  </head>
  <body>
    <div class='header'>
      <span><img id="file-image" src="{{url('/logo/',[$reports['Logo']])}}" /></span>
      <span>{{$reports['CName']}}</span>
    </div>
    <table border=1 class="table table-bordered">
    <caption><b>Health Report</b></caption>
      <tr>
        <td>
          Physician Name
        </td>
        <td>
          {{$reports['DName']}}
        </td>
      </tr>
      <tr>
        <td>
          Physician Contact
        </td>
        <td>
          {{$reports['DContact']}}
        </td>
      </tr>
      <tr>
        <td>
          Patient First Name
        </td>
        <td>
          {{$reports['PFName']}}
        </td>
      </tr>
      <tr>
        <td>
          Patient Last Name
        </td>
        <td>
          {{$reports['PLName']}}
        </td>
      </tr>
      <tr>
        <td>
          Patient DOB
        </td>
        <td>
          {{ \Carbon\Carbon::parse($reports['PDOB'])->format('d/m/Y')}}
        </td>
      </tr>
      <tr>
        <td>
          Patient Contact
        </td>
        <td>
          {{$reports['PContact']}}
        </td>
      </tr>
      <tr>
        <td>Complaint</td>
        <td>{{$reports['Complaint']}}</td>
      </tr>
      <tr>
        <td>Consultation</td>
        <td>{{$reports['Consultation']}}</td>
      </tr>
    </table>
    <div class='footer'>
      <span>This report is generated on {{ \Carbon\Carbon::parse($reports['created_at'])->format('d/m/Y H:i:s')}} from {{$_SERVER['REMOTE_ADDR']}}</span>
      <span>1</span>
    </div>
  </body>
</html>
<div style="border:1px solid #ccc;color: #000;font-family: Arial,Helvetica,sans-serif;font-size:14px;">
  <div class="title" style="background-color: #ccc;padding: 10px">
    <h1 align="center" style="color: rgb(230, 16, 16)">Sarey Solution</h1>
    <h4 align="center">Invoice #{{$invoice_number}}</h4>
   </div>
    <div class="float-container" style="border: 3px solid #fff;padding: 10px;">

        <div style="width: 50%;float: left;">
          <h3>To:</h3>
          <small>{{$client[0]->full_name}}<br>{{$client[0]->email}}<br> {{$client[0]->address}}</small>
        </div>
        
        <div >
          <h3>From:</h3>
          <small>Sarey Solution <br>Tartu mnt 67/1-13b Tallinn,<br> Harjumaa, Estonia 10115 </small>
        </div>
        
      </div>
    <table width="100%" cellspacing="0" cellpadding="0" style="border:1px solid rgb(10, 10, 10);background-color: #ccc;">
        <tr>
            <th align="" style="border:1px solid #000;text-align: left;padding: 7px;">No</th>
            <th style="border:1px solid #000;text-align: left;padding: 7px;">Item Description</th>
            <th style="border:1px solid #000;text-align: left;padding: 7px;">Price</th>
            <th style="border:1px solid #000;text-align: left;padding: 7px;">Quantity</th>
            <th style="border:1px solid #000;text-align: left;padding: 7px;">Total</th>
        </tr>
        @php $couter=1; $total=0; @endphp
        @foreach ($invoice as $row )
        <tr>
            <td style="border:1px solid #000;border-collapse: collapse;padding: 7px;">{{$couter++}}</td>
            <td style="border:1px solid #000;border-collapse: collapse;padding: 7px;">{{$row->description}}</td>
            <td style="border:1px solid #000;border-collapse: collapse;padding: 7px;">@if($client[0]->currency=="USD") $ @elseif ($client[0]->currency=="GBR") £ @else  € @endif {{$row->amount}} </td>
            <td style="border:1px solid #000;border-collapse: collapse;padding: 7px;">{{$row->qty}}</td>
            <td style="border:1px solid #000;border-collapse: collapse;padding: 7px;">@if($client[0]->currency=="USD") $ @elseif ($client[0]->currency=="GBR") £ @else  € @endif {{$row->amount*$row->qty}}</td>
        </tr>
        @php  $total+=(int)$row->amount*(int)$row->qty; @endphp
        @endforeach
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                <h4 style="">Total: @if($client[0]->currency=="USD") $ @elseif ($client[0]->currency=="GBR") £ @else  € @endif {{$total}} </h4>
                    
                </td>
            </tr>
        </tfoot>
      </table>
      <div style="text-align: center;margin-top: 10px">
          <a  href="{{url('checkout')}}/{{$invoice_number_hash}} " class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:14px;border-style:solid;border-color:#201d1d;border-width:10px 30px 10px 30px;display:inline-block;background:#1a1919;border-radius:3px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:bold;font-style:normal;line-height:17px;width:auto;text-align:center">Click to process payment</a></td> 
        </div>  
      <p align="center">Powered By <a href="https://sarey.co" target="_blank">Sarey.co</a> </p>



</div>
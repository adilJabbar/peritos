<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="STYLESHEET" href="pdfcss/print_static.css" type="text/css" />
    <style>

        .section-title {
            background-color: #000;
        }

        .anexos-container-padding {
            padding: 10px;
        }

        #pictures-table div p {
            margin: 0 .25em;
            padding: .25em 0;
        }

        #pictures-table .picture {
            float:left;
            width:50%;
            text-align: center;
        }

        #pictures-table .new_line {
            clear:both;
        }
    </style>
</head>

<body>

<div id="body">

    <div id="section_header">
    </div>

    <div id="content">

        <div class="page" style="font-size: 7pt">
            <table style="width: 100%;" class="header">
                <tr>
                    <td><h1 style="text-align: left">{{__('ACTUALIZACIÓN DE ESTADO')}}</h1></td>
                    <td><h1 style="text-align: right">{{__('Expediente')}}: {{$expedient->full_code}}</h1></td>
                </tr>
            </table>
            <table style="width: 100%; font-size: 8pt;">
                <tr>
                    <td>{{__('Solicitante')}}: <strong>{{$expedient->billable->name}}</strong></td>
                    <td>{{__('Asegurado')}}: <strong>{{$expedient->person->name}}</strong></td>
                </tr>

                <tr>
                    <td>{{__('Referencia')}}: <strong>{{$expedient->reference}}</strong></td>
                    <td>{{__('Dirección')}}: <strong>{{$expedient->address->address . ' - ' . $expedient->address->full_city}}</strong></td>
                </tr>

                <tr>
                    <td>{{__('Tramitador')}}: <strong>{{$expedient->agent->name ?? __('No asignado')}}</strong></td>
                    <td>@forelse($expedient->person->contacts as $contactOption)
                            {{__($contactOption->type)}}: <strong>{{$contactOption->value}}</strong><br>
                        @empty

                        @endforelse
                    </td>
                </tr>
            </table>

            <table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 8pt;">

                <tr>
                    <td>{{__('Ramo')}}: <strong>{{$expedient->ramo->name}}</strong></td>
                    <td>{{__('Situación')}}: <strong>{{$expedient->status->name}}</strong></td>
                    <td>{{__('Gabinete')}}: <strong>{{$gabinete->name}}</strong></td>
                    <td>{{__('Técnico')}}: <strong>{{$expedient->adjuster->full_name ?? __('No asignado')}}</strong></td>
                </tr>

            </table>

            <table class="change_order_items">

                <tr>
                    <td colspan="1"><h2>{{__('Reserva actual')}}:</h2></td>
                    <td colspan="3"><h1><x-output.currency value="{{$advanceContent['reserve']}}" :currency="$expedient->currency()" /></h1></td>
                </tr>

            </table>

            <table class="change_order_items">
                <tbody>
                    <tr class="odd_row">
                        <td>
                            <p style="text-align: right">{{$advanceContent['date']}}</p>
                            <p>{!! $advanceContent['text'] !!}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            @if($advanceContent['pictures'])
                <div id="pictures-table">
                    <div class="section-title"><h1 style="color: #FFFFFF;">{{__('ANEXOS')}}</h1></div>

                    <div>
                        <div class="anexos-container-padding">
                            <p><h1 style="text-align: left">{{__('Fotografías')}}</h1></p>
                            @foreach($advanceContent['pictures'] as $picture)
                                <div class="picture">
                                    <img style="max-height: 200px; margin-top: 30px;" src="{{$picture->pdf_url}}" alt="">
                                    <p style="text-align: center">{{$picture->name}}</p>
                                    <p style="text-align: center">{{$picture->comments}}</p>
                                </div>
                                @if($loop->iteration % 2 == 0)
                                    {!! '<div class="new_line"><p></p></div>' !!}
                                @endif
    {{--                            <div class="new_line"><p>Cambio de linea</p></div>--}}
                            @endforeach

                            <div class="new_line"><p></p></div>
                        </div>
                    </div>

                </div>
            @endif
{{--            @if($advanceContent['pictures'])--}}
{{--                <table class="change_order_items">--}}
{{--                    <tbody>--}}
{{--                        <tr>--}}
{{--                            @foreach($advanceContent['pictures'] as $picture)--}}
{{--                            <td style="width: 45%; height: 200px;">--}}
{{--                                <img src="{{$picture->pdf_url}}" alt="">--}}
{{--                                <p style="text-align: center;">{{$picture->name}}</p>--}}
{{--                                <span>{{$picture->comments}}</span>--}}
{{--                            </td>--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            @endif--}}


            <div>
                @if($advanceContent['includeAdvanceHistory'])
                    <div class="section-title"><h1 style="color: #FFFFFF;">{{__('ACTUALIZACIONES PREVIAS')}}</h1></div>
                    <table class="change_order_items">

                        <tbody>
                        @forelse($expedient->sent_documents()->where('type', 'advance') as $document)
                            <tr class="{{$loop->iteration % 2 == 0 ? 'even_row' : 'odd_row'}}">
                                <td>
                                    <p style="text-align: right">{{$document->created_at->isoFormat('LLLL')}}</p>
                                    <p>{!! $document->advance->text ?? __('Avance sin contenido') !!}</p>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td>
                                {{__('No se ha enviado ninguna actualización anterior.')}}
                            </td>
                        </tr>
                        @endforelse


                        </tbody>




{{--                        <tr>--}}
{{--                            <td colspan="3" style="text-align: right;">(Tax is not included; it will be collected on closing.)</td>--}}
{{--                            <td colspan="2" style="text-align: right;"><strong>GRAND TOTAL:</strong></td>--}}
{{--                            <td class="change_order_total_col"><strong>$7560.00</strong></td>--}}
{{--                        </tr>--}}
                    </table>

                @endif
            </div>

            <table class="sa_signature_box" style="border-top: 1px solid black; padding-top: 2em; margin-top: 2em;">

                <tr>
                    <td>{{__('FECHA')}}:</td><td class="written_field" style="padding-left: 0.5in; padding-right: 0.5in;">{{$advanceContent['date']}}</td>
                    <td style="padding-left: 1em">{{__('FIRMA')}}:</td><td class="written_field" style="padding-left: 2.5in; text-align: right;">X</td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-top: 0em">&nbsp;</td>
                    <td style="text-align: center; padding-top: 0em;">{{auth()->user()->full_name}}</td>
                </tr>

                <tr><td colspan="4" style="white-space: normal">
                    {{__('El contenido de este documento es una actualización del estado del expediente. Tanto la información como la reserva se han realizado de forma estimada, no suponiendo en ningún caso una propuesta en firme, ni en cuanto a las cantidades aquí reflejadas, ni en lo referente a las posibles coberturas o exclusiones, que se recogeran en el informe definitivo.')}}
                    </td>
                </tr>

            </table>

        </div>

    </div>
</div>

<script type="text/php">

if ( isset($pdf) ) {

  $font = $fontMetrics->get_font("verdana");
  // If verdana isn't available, we'll use sans-serif.
  if (!isset($font)) { $fontMetrics->get_font("sans-serif"); }
  $size = 6;
  $color = array(0,0,0);
  $text_height = $fontMetrics->get_font_height($font, $size);

  $foot = $pdf->open_object();

  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - 2 * $text_height - 24;
  $pdf->line(16, $y, $w - 16, $y, $color, 1);

  $y += $text_height;

  $text = "{{__('Expediente')}}: {{$expedient->full_code}}";
  $pdf->text(16, $y, $text, $font, $size, $color);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

  global $initials;
  $initials = $pdf->open_object();

  // Add an initals box
  $text = "{{__('Iniciales')}}:";
  $width = $fontMetrics->get_text_width($text, $font, $size);
  $pdf->text($w - 16 - $width - 38, $y, $text, $font, $size, $color);
  $pdf->rectangle($w - 16 - 36, $y - 2, 36, $text_height + 4, array(0.5,0.5,0.5), 0.5);


  $pdf->close_object();
  $pdf->add_object($initials);

@if($watermark)
  // Create the watermark
  $pdf->page_text(110, $h - 240, "{{__($watermark)}}", $fontMetrics->get_font("verdana", "bold"),
             90, array(0.85, 0.85, 0.85), 0, 0, -52);
@endif

  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";

  // Center the text
  $width = $fontMetrics->get_text_width("Page 1 of 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);

}
</script>

</body>
</html>

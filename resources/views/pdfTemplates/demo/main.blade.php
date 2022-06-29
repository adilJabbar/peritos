<!DOCTYPE>
<html xml:lang="es" lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>

</head>

<style>
    * {
        margin: 0;
        padding: 0;
        text-indent: 0;
        font-family: Arial, sans-serif;
    }


    /** Define now the real margins of every page in the PDF **/
    body {
        margin-top: 80px;
        margin-bottom: 30px;
        /*counter-reset: page -1;*/
    }


    #footer .page:after {
        content: "Page " counter(page, decimal);
        padding: 20px 12px;
        border-radius: 50px;
        font-weight: bold;

    }

    @page {
        margin: 100px 20px;

    }

    .main {
        page-break-before: always;
        counter-reset: heading;

    }

    .break-all-line {

        page-break-before: always;
    }

    .main ol h1:before {

        content: counter(heading, decimal) " ";
        counter-increment: heading;
    }

    .main ol li ol {
        counter-reset: subheading;
        padding: 10px 0px 10px 10px !important;
    }

    .main ol ol li h2 {
        padding-bottom: 10px;
    }

    .main ol ol > li > h2:before {
        content: counter(heading) "." counter(subheading, decimal) " ";
        counter-increment: subheading;
    }

    h1 {
        color: #034997;
        font-style: normal;
        font-weight: bold;
        font-size: 19px;
        border-bottom: 1px solid #034997;
    }

    h2 {
        color: #034997;

        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 11pt;
    }

    h3 {
        color: #FFF;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 9.5pt;
    }

    p {
        color: #000000;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 13px;
        /*padding-top: 20px;*/
        /*padding-top: 4px;*/
        padding-bottom: 6px;
        text-align: justify;
        line-height: 1.7;
    }

    .a,
    a {
        color: #000000;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 13px;
    }

    li {
        display: block;
    }

    #l1, .photos {
        /* counter-reset: c1 1; */
        padding: 0 80px;
        margin: 20px 0;
    }


    /* #l1>li>*:first-child:before {*/
    /*    counter-increment: c1;*/
    /*    content: counter(c1, decimal) ". ";*/
    /*    color: #034997;*/
    /*    font-style: normal;*/
    /*    font-weight: bold;*/
    /*    font-size: 19px;*/
    /*}*/

    /*#l1>li:first-child>*:first-child:before {*/
    /*    counter-increment: c1 0;*/
    /*}*/

    .s1 {
        color: black;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 14.5pt;
    }

    .s2 {
        color: #034997;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 12.5pt;
    }

    .s3 {
        color: #7D8997;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9.5pt;
    }

    .s4 {
        color: #034996;

        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
    }

    .s5 {
        color: #034997;

        font-style: normal;
        font-weight: bold;
        text-decoration: underline;
        font-size: 14.5pt;
    }

    .s6 {
        color: #5B5B5B;

        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 14.5pt;
    }

    .s7 {
        color: #5B5B5B;

        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9.5pt;
    }

    .s8 {
        color: #5B5B5B;

        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 14.5pt;
    }

    .s9 {
        color: #FFF;

        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 9.5pt;
    }

    .s10 {
        color: black;
        font-family: "Times New Roman", serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }

    .s11 {
        color: black;

        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }

    .s12 {
        color: black;
        font-family: "Times New Roman", serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
        vertical-align: 31pt;
    }

    table,
    tbody {
        vertical-align: top;
        overflow: visible;
    }

    #header {
        position: fixed;
        /*top: 0px;*/
        height: 80px;
        background-color: transparent;

        text-align: center;
        border-bottom: 1px solid #034997;

    }

    #footer {
        position: fixed;
        bottom: 0px;
        height: 70px;

        background-color: transparent;
        color: white;
        text-align: center;
        border: 1px solid #034997;

    }

    #header h2, #footer h2 {
        /*line-height: 75px;*/
        font-size: 36px;
    }
    .index{
        padding-top: 20px;
    }
    .index ol {
        /*display: none !important;*/
        page-break-after: avoid;
        page-break-before: avoid;
        page-break-inside: avoid;
        margin: 5px 0px !important;
    }
    .index ol h2 {

        padding: 5px 30px !important;
    }
    .index h1,.index h2{
        border:none;
    }

    /*.index * {*/
    /*    display: none;*/
    /*}*/


    .index .sub-heading-parent *, .index ol ol li {
        display: none;
    }

    .index > ol > li.heading-parent, .index ol ol li.sub-heading-parent {
        display: block !important;
    }

    .index > ol > li.heading-parent h1, .index ol ol li.sub-heading-parent h2 {
        display: block !important;
    }

    .index ol li.heading-parent h1 + *, .index ol li.photos1, .index ol ol .sub-heading-parent h2 + * {
        display: none !important;
    }
    .index {
        counter-reset: heading1;

    }
    .index ol h1:before {

        content: counter(heading1, decimal) ". ";
        counter-increment: heading1;
    }

    .index ol li ol {
        counter-reset: subheading2;
    }

    .index ol ol > li > h2:before {
        content: counter(heading1) "." counter(subheading2, decimal) " ";
        counter-increment: subheading2;
        display: inline !important;
    }


</style>

<body>
<div id="header">
    <h2>Header de prueba</h2>
</div>

{{--<footer>--}}
{{--    <p>Copyright &copy; <?php echo date("Y");?></p>--}}
{{--</footer>--}}
<div id="footer">
    <h2>Footer al final</h2>
    <p class="page"></p>
</div>
@foreach( ["index","main"]  as $a)
    <div class="{{ $a }}">
        @include('pdfTemplates.demo.order_data')
        @include('pdfTemplates.demo.third_party')
        @include('pdfTemplates.demo.previous_section_mapfre')
        @include('pdfTemplates.demo.cause_and_circumstances')
        @include('pdfTemplates.demo.conclusions_and_coverage')
        @include('pdfTemplates.demo.clarifications_to_the_valuation')
        @include('pdfTemplates.demo.firms')
        @include('pdfTemplates.demo.photographic_annexes')
    </div>
@endforeach


</body>

</html>

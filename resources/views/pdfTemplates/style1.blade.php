<style media="screen">
    @page {
        margin: 0;
        margin-top:160px;
        margin-bottom:200px;
        margin-right:60px;
        margin-left:60px;
    }

    html {
        counter-reset: section;
    }

    hr.primary-thick {background-color: {{$gabinete->color_primary}}; height: 3px;}
    h1 {}
    #watermark { position: fixed; top: -160px; left: -60px; right: -60px; bottom: -200px; z-index:-10;}
    #header { position:fixed; top: -120px; height: 120px}
    .image-logo {display:block; height: 100%; padding-top: 13px;}
    .content {z-index: 100;}
    .no-margins { margin-left: -60px; margin-right: -60px;}
    .bold { font-weight: bold;}
    .large { font-size: large;}
    .uppercase { text-transform: uppercase;}
    .color-primary {color:{{$gabinete->color_primary}};}
    .color-secondary {color:{{$gabinete->color_secondary}};}


    .section h1 {
        counter-increment: section;
        background-color: {{$gabinete->color_primary}};
        color:{{$gabinete->color_primary_text}};
        margin-top: 15px;
        padding-left: 15px;
    }

    .section h1:before {
        content: counter(section) ". ";
    }

    ol {
        counter-reset: section;
        margin: 0;
        padding: 0;
    }

    li {
        counter-increment: section;
        display: block;
        margin: 0 0 0 30px;
        padding: 0 0 0 50px;
        page-break-inside: avoid;
        position: relative;
        color:{{$gabinete->color_primary}};
        margin-top: 5px;
    }

    li:before {
        content: counters(section, ".") " ";
        display: block;
        position: absolute;
        left: 0;
    }


    td img { max-width: none; width: 100% }


    /*Tables*/
    table { position:relative; width:100%; border-spacing:5px;}
    table td {padding:5px; }
    /*table td.sombreado { background:#E2E6F4;}*/
    /*table td.titulo { text-align:left; background-color: #48bb78}*/
    /*table td.bigger { font-size: 30px; font-weight:bold;}*/
    /*table td.insta { text-align:right;}*/

    .right {text-align: right}

</style>

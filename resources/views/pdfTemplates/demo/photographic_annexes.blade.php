<style type="text/css">
    .photos1 table tr {
        padding: 0;
    }

    .photos1 table tr td {
        width: 50% !important;
        padding-left: 20px !important;
        padding-top: 20px;
        /*margin-right: 20px;*/
    }

    .photos1 table tr.full td {
        width: 100% !important;
        padding-left: 20px !important;
        padding-top: 20px;
        /*margin-right: 20px;*/
    }

    .photos1 table tr td img {
        width: 92%;
        page-break-before: auto;
        page-break-inside: avoid;
    }
</style>

<ol class="photos break-all-line">


    <li class="heading-parent">
        <h1 class="heading">PHOTOGRAPHIC ANNEXES</h1>
    </li>
    <li class="photos1">
        <table border="0" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <td>
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png">
                </td>
                <td>
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png">
                </td>
            </tr>
            <tr>
                <td>
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png">
                </td>
                <td>
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png">
                </td>
            </tr>
            @foreach(["line","bar","pie"] as $x)


                <tr class="full">
                    <td colspan="2" style="text-align: center;">
                        @php
                            $chartConfig = '{
                                  "type": "'.$x.'",
                                  "data": {
                                    "labels": [2012, 2016, 2018, 2019, 2021],
                                    "datasets": [{
                                      "label": "Users",
                                      "data": [120, 60, 50, 1500, 10]
                                    },{
                                      "label": "developer",
                                      "data": [10, 50, 60, 300, 100]
                                    },{
                                      "label": "sfda",
                                      "data": [110, 520, 630, 0, 20]
                                    }]
                                  }
                                }';
                           $chartUrl = 'https://quickchart.io/chart?w=500&h=300&c=' . urlencode($chartConfig);

                        @endphp
                        <img src="{{ $chartUrl }}" width="70%" alt="" style="display: block;">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </li>
</ol>


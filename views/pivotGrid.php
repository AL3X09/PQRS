<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basic TreeGrid - jQuery EasyUI Demo</title>
        <link href="../libs/easyui/themes/default/easyui.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/themes/icon.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/easyui/demo/demo.css" rel="stylesheet" type="text/css"/>
        <script src="../libs/easyui/jquery.min.js" type="text/javascript"></script>
        <script src="../libs/easyui/jquery.easyui.min.js" type="text/javascript"></script>
        <link href="../libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../libs/bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
        <style id="pivotgrid-style"> a.pivotgrid - item, a.pivotgrid - item:hover{text - align:left; - moz - border - radius:0; - webkit - border - radius:0; border - radius:0; }a.pivotgrid - item - ins{border - top:1px solid red; }.pg - fbar{padding:0; }.pg - flabel{display:inline - block; height:22px; line - height:22px; vertical - align:middle; margin:0 5px; }</style>
    </head>
    <body>
        <h2>Pivot Grid</h2>
        <p>The PivotGrid allows you to quickly do a lot of reporting & analysis from a table of data.</p>
        <div style="margin-bottom:10px">
            <a href="javascript:void(0)" class="easyui-menubutton" style="width:70px;height:78px;" data-options="size:'large',iconCls:'icon-load',iconAlign:'top',plain:false,menu:'#mm'">Load</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" style="width:70px;height:78px;" data-options="size:'large',iconCls:'icon-layout',iconAlign:'top',plain:false" onclick="javascript:$('#pg').pivotgrid('layout')">Layout</a>
        </div>
        <div id="mm" style="display:none">
            <div onclick="load1()">Load Data1</div>
            <div onclick="load2()">Load Data2</div>
        </div>
        <table id="pg" style="width:700px;height:300px"
               data-options="
               url: '../php/getTyping.php',
               method: 'post',               
               "></table>
        <style type="text/css">
            .icon-load{
                background:url('load.png') no-repeat center center;
            }
            .icon-layout{
                background:url('layout.png') no-repeat center center;
            }
            .demo-rtl a.pivotgrid-item{
                text-align: right;
            }
        </style>
        <script type="text/javascript" src="../libs/easyui/src/jquery.pivotgrid.js"></script>
        <script type="text/javascript">
                $(function () {
                    load1();
                });
                function load1() {
                    $('#pg').pivotgrid({
                        pivot: {
                            rows: ['Nombre'],
                            columns: [''],
                            values: [
                                {field: 'total', op: 'sum'},
                                {field: 'Discount', op: 'sum'}
                            ]
                        },
                        forzenColumnTitle: '<span style="font-weight:bold">Pivot Grid</span>',
                        valuePrecision: 0,
                        valueStyler: function (value, row, index) {
                            if (/Discount$/.test(this.field) && value > 100 && value < 500) {
                                return 'background:#D8FFD8'
                            }
                        }
                    })
                }
                function load2() {
                    $('#pg').pivotgrid({
                        url: 'pivotgrid_data2.php',
                        method: 'get',
                        pivot: {
                            rows: ['form', 'name'],
                            columns: ['year'],
                            values: [
                                {field: 'gdp'},
                                {field: 'oil'},
                                {field: 'balance'}
                            ]
                        },
                        valuePrecision: 3,
                        valueStyler: function (value, row, index) {
                            if (/balance$/.test(this.field) && value < 0) {
                                return 'background:pink'
                            }
                        }
                    })
                }
        </script>
    </body>
</html>
<?php

if (!function_exists('includeDT')) {
    function includeDT()
    {
        return printCss([
                'libs/datatables/datatables.css'
            ]).printScript([
                'libs/datatables/datatables.js'
            ]);
    }
}

if (!function_exists('includeDTCheckboxes')) {
    function includeDTCheckboxes()
    {
        return printScript([
            'libs/datatables/dataTables.checkboxes.min.js'
        ]);
    }
}

if (!function_exists('makeTable')) {
    function makeTable($columns,$records = false,$id = 'table-generated',$checked = false)
    {
        $html = '<table class="datatables-demo table table-striped table-bordered" id="'.$id.'">';
        $html = $html . getTableHeader($columns,$checked);
        if ($records) {
            $html = $html . getTableRows($columns,$records);
        }
        return $html . '</table>';
    }
}

if(!function_exists('getTableHeader')) {
    function getTableHeader($cols,$checked)
    {
        $html = '<thead>';
        $html = $html . '<tr>';
        if ($checked) {
            $html = $html .'<th><input type="checkbox" class=""  value="all" name="all_checked" id="check_all_table"></th>';
        } else {
            $html = $html .'<th>Id</th>';
        }
        for($i = 0;$i<count($cols);$i++){
            $html = $html . '<th>';
            $html = $html . ucwords(str_replace('_',' ',$cols[$i]));
            $html = $html . '</th>';
        }
        $html = $html . '</tr>';
        return $html . '</thead>';
    }
}

if (!function_exists('getTableRows')) {
    function getTableRows($columns,$records)
    {
        $x = 1;
        $html = '<tbody>';
        foreach ($records as $r){
            $html = $html . '<tr>';
            $html = $html . '<td>'.$x.'</td>';
            for($i = 0;$i<count($columns);$i++){
                $html = $html . '<td>';
                $html = $html . $r[$i];
                $html = $html . '</td>';
            }
            $html = $html . '</tr>';
            $x++;
        }
        return $html . '</tbody>';
    }
}

if (!function_exists('getSimpleTableScript')) {
    function getSimpleTableScript($id = 'table-generated')
    {
        return "<script>
                   $('#$id').DataTable({
                        pageLength: 25          
                   });
                </script>";
    }
}


if (!function_exists('getAjaxTable')) {
    function getAjaxTable($url,$id = 'table-generated',$title = 'Generado por sistema')
    {
        return "<script>
                    var table = $('#" . $id . "').DataTable({
                        pageLength: 25,
                        'ajax': '/datatable/" . $url . "/'            
                    });
                    
                    function tableReload() {
                        table.ajax.reload( false, false );
                    } 
                </script>";
    }
}

if (!function_exists('getAjaxTableWithCheckboxes')) {
    function getAjaxTableWithCheckboxes($url,$id = 'table-generated', $title = 'Generado por Sistema')
    {
        return "<input type='hidden' value='' id='selected_items'>
                <script>
                 var table = $('#" . $id . "').DataTable({
                        pageLength: 25,
                        responsive: true,
                        'ajax': '/datatable/" . $url . "/',
                            columnDefs: [
                                {
                                    'targets': 0,
                                    'orderable':false,
                                    'checkboxes': {
                                        'selectRow': true
                                },
                                    'className' : 'select-checkbox'
                                }
                            ],
                            order: [ 0, 'asc' ],
                            select : {
                                 style:    'multi',
                                 selector: 'td:first-child'
                            }
                    });
              
                $('#check_all_table').change(function(){
                    var cells = table.cells( ).nodes();
                    $( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));
                });
                function getSelectedRows(){
                     var rows_selected = table.column(0).checkboxes.selected();
                     $('#selected_items').val('');
                     $.each(rows_selected, function(index, rowId){
                          var select = $('#selected_items').val();
                          var newval = rowId;
                          if (select === '') {
                              $('#selected_items').val(newval);
                          } else {
                              var add = select + ',' + newval;
                              $('#selected_items').val(add);
                          }
                     });        
                     var items = $('#selected_items').val();
                     return items;
                }
                $(document).ready(function(){
                   $('.get-selected-rows').on('click',function(){
                        alert(getSelectedRows());
                   });  
                });      
               function tableReload() {
                    table.ajax.reload( false, false );
               } 
            </script>";
    }
}

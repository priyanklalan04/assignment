@extends('layouts.layout')

@section('title','all user data')

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1>UserData</h1>
    </div>
    <div class="col-md-8">
        <input id="user_search" type="text" class="form-control" name="searchuser" placeholder="Search for user...">
        <hr>    
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <h4></h4> 
            <p></p> 
        </div>
    </div>
    <div class="col-md-8 x_content">
        <table class="table table-striped table-bordered" id="userdata_table">
            <thead>
                <tr>
                    <th class="data_sorting" data-sorting_type="asc" data-column_name="name">Username</th>
                    <!-- <th>Email</th> -->
                    <th class="data_sorting" data-sorting_type="asc" data-column_name="created_at">Created at</th>
                </tr>
            </thead>
            <tbody id="userdata_table_body">
                @include('ajaxdata')
            </tbody>
        </table>
    </div>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1"/>
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="created_at"/>
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc"/>
</div>
<script type="text/javascript">
    BASE_URL = "{{ url('/') }}";
    $(document).ready(function(){
        function fetch_data(page,sort_type="",sort_by="",search=""){
            var userdata = {page:page,sorttype:sort_type,sort_by:sort_by,search:search};
            // console.log(userdata);
            $.ajax({
                url:BASE_URL+"/test_ajax",
                data:userdata,
                success:function(data){
                    $('#userdata_table_body').html(data);
                    // console.log(data);
                }
            });
        }
        $(document).on('keyup',"#user_search",function(){
            var user_search = $("#user_search").val();
            var column_name = $("#hidden_column_name").val();
            var sort_type = $("#hidden_sort_type").val();
            var page = $("#hidden_page").val();
            console.log(user_search);
            fetch_data(page,sort_type,column_name,user_search);
        });

        $(document).on('click',".data_sorting",function(){
            var column_name = $(this).data('column_name');
            var order_type = $(this).data('sorting_type');
            var reverse_order = '';
            if(order_type == 'asc'){
                $(this).data('sorting_type','desc');
                reverse_order = 'desc'
            }else{
                $(this).data('sorting_type','asc');
                reverse_order = 'asc'
            }
            $("#hidden_column_name").val(column_name);
            $("#hidden_sort_type").val(reverse_order);
            var user_search = $("#user_search").val();
            var page = $("#hidden_page").val();
            fetch_data(page,reverse_order,column_name,user_search);
        });

        $(document).on('click',".exam_pagin_link a",function(e){
            e.preventDefault();
            var user_search = $("#user_search").val();
            var column_name = $("#hidden_column_name").val();
            var sort_type = $("#hidden_sort_type").val();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page,sort_type,column_name,user_search);
        });

        $(document).on('click',"#data_info",function(){
            var currentRow=$(this).closest("tr"); 
            $(".card h4").text($(currentRow.find('input')).data('name'));
            $(".card p").text($(currentRow.find('input')).data('email'));           
        });
    });
</script>
@stop
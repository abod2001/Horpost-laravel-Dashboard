@extends('layouts.layout')
@section('content')

    <div class="container">
        @if(session()->has('status'))
            <div class="alert alert-success text-right">
                    <p class="text-right p-1">{{ session()->get('status') }}</p>
            </div>
        @endif
        <div class="card ">
            <div class="card-body">
                <div class="breadcrumb-line header-elements-md-inline">
                    <div class="d-flex h-flex">
                        <div class="breadcrumb" style="border: none !important ; background: none; font-size: 19px ; padding: 8px !important">
                            <a href="" class="breadcrumb-item"><i class="fas fa-home"></i> الرئيسية</a>
                            <span class="breadcrumb-item active">لوحة التحكم</span>
                            <span class="breadcrumb-item active">التحكم بالمنظمات</span>
                        </div>
                        <a href="" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
                <div class="data-organization" style="margin-bottom: 30px">
                    <div class="text-right " style="margin-bottom: 30px">
                        <a style="font-size: 20px"><i class="fas fa-bookmark ml-2"></i>عرض الأقسام :</a>
                    </div>
                </div>
                <table class="table table-bordered table-striped text-right" style="font-size: 18px;width: 1000px;" id="section_table">
                    <thead>
                    <tr>
                        <th class="text-center h-bordertop " scope="col">#</th>
                        <th class="text-center h-bordertop" scope="col">اسم القسم</th>
                        <th class="text-center h-bordertop" scope="col">التحكم</th>

                    </tr>
                    </thead>

                </table>

                <!--modal to edit-->
                <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">تعديل القسم</h5>
                                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="edit_from">
                            <div class="modal-body">
                                <input class="form-control" type="text" name="section_name" value="" placeholder="Section Name">
                            </div>
                            <div class="modal-footer text-left">
                                <button type="submit" id="save" class="btn btn-primary">حفظ</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end this modal-->
            </div>
        </div>

    </div>
@endsection
@section('js')
<script>
        $(document).ready(function (){
            let table = $('#section_table');
           table.DataTable({
                responsive: true,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    'lengthMenu': 'Display _MENU_',
                },
                order: [[ 0, "desc" ]],
                searchDelay: 500,
                processing: true,
                serverSide: true,
                border:0,
                ajax: '{{ route('sections') }}',
                columns: [
                    {data: 'id',orderable: true, searchable: false},
                    {data: 'section_name'},
                    {data: 'action'},
                ],
            });
            let modal = $('#EditModal');
            let id;
            $('table').on('click','.edit_btn',function (){
               id = $(this).data('id');
                let name=$(this).data('name');
                modal.find('input[name=section_name]').val(name);
                modal.modal('show');
            });

            $('#edit_from').submit(function (e){
                e.preventDefault();
                let data = $(this).serialize()+'&id=' + id;

                if(modal.find('input[name=section_name]').val() == ''){
                    alert('Enter Section Name');
                }else{
                    $.ajax({
                        url:'{{ route('section.update') }}',
                        type:'put',
                        data: data,
                        success: function (data){
                            modal.modal('hide');
                            table.DataTable().ajax.reload();
                        }
                    })
                }
            })




            $('table').on('click','.delete_btn',function (){
                let id=$(this).data('id');
                let _this=$(this);
                $.ajax({
                    url:'{{route('section.delete')}}',
                    type:'delete' ,
                    data:{
                        id:id,
                        },
                    success:function (data){
                        _this.parent().parent().remove();
                    },error:function (err){
                        alert("Try Again")
                    }
                })
            })
        })
    </script>
@endsection

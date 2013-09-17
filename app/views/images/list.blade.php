@extends('layouts.master')

@section('main_menu')
    @parent
@stop

@section('login')
    @parent
@stop

@section('content')

    <div class="row" id="pics">

        @foreach($images as $image)

            <div class="col-sm-2">
                <a href="{{ route('show_image', array('id' => $image->id)) }}">
                    {{ HTML::image('uploads/' . $image->id . '/' . $image->img_min, $image->img_min, array('class' => 'img-responsive img-thumbnail')) }}
                </a>
            </div>

        @endforeach

        <br class="clear"/>
        <?php echo $images->links(); ?>

    </div>

@stop

@section('add_script')
    {{ HTML::script('assets/js/infinitescroll.js') }}
    <script>
        $('.pager').hide();
        $('#pics').infinitescroll({
            navSelector     : ".pager",
            nextSelector    : ".pager a:last",
            itemSelector    : ".col-sm-2",
            debug           : false,
            dataType        : 'html',
            path: function(index) {
                return "?page=" + index;
            },
            loading: {
                finishedMsg: ""
            }
        }, function(newElements, data, url){

            var $newElems = $( newElements );
            $('#pics').masonry( 'appended', $newElems, true);

        });
    </script>
@stop
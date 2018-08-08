

<div id="topBar">
    <div class="left">
        <div class="postNavigation" style="display: none;">
            <span id="title">Print Alert</span>
            <span class="button prevClick" title="Previous Entry">
                <i class="fas fa-step-backward"></i>
            </span>
            <span class="button nextClick" title="Next Entry">
                <i class="fas fa-step-forward"></i>
            </span>
            <button class="licensePostClick button far fa-copy" title="Copy Post">License & Copy</button>
        </div>
    </div>
    <div class="right">
        {{--TODO: style button--}}
<?php $level = Auth::user()->level; ?>
        @if($level > 0)
        <div class="adminControls">
            <span class="button showPostCreateFormClick" title="Create">
                <i class="fas fa-plus"></i>
            </span>
            <span class="button editPostClick" title="Edit" style="display:none;">
                <i class="fas fa-edit"></i>
            </span>
            <span class="button formSaveClick" title="Save" style="display:none;">
                <i class="fas fa-save"></i>
            </span>
            {{--<span class="button" title="Increase Font Size">--}}
                {{--<i class="fas fa-search-plus"></i>--}}
            {{--</span>--}}
            {{--<span class="button" title="Decrease Font Size">--}}
                {{--<i class="fas fa-search-minus"></i>--}}
            {{--</span>--}}
        </div>
        @endif
    </div>
    <div id="scrollBar">
        <div id="color"></div>
    </div>
</div>
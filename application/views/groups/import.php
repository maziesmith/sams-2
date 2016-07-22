<section id="content">
    <div class="container">
        <div class="card">
            <?php echo breadcrumbs('','Import Group'); ?>

            <div class="card-body card-padding">
                Cras leo sem, egestas a accumsan eget, euismod at nunc. Praesent vel mi blandit, tempus ex gravida, accumsan dui. Sed sed aliquam augue. Nullam vel suscipit purus, eu facilisis ante. Mauris nec commodo felis.

                <div class="listview lv-bordered lv-lg">

                    <div class="lv-body">
                        <div class="lv-item media"  style="padding-left: 0">
                            <div class="media-body">
                                <div class="lv-title">ID, Course Name, Course Desc, Program Name, Course Fee </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form>
                    <p class="f-500 c-black">Import CSV FILE</p>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <span class="btn btn-primary btn-file m-r-10">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="...">
                        </span>
                        <span class="fileinput-filename"></span>
                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
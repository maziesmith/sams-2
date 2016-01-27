<section id="content">
    <div class="container">
        <div class="card">
            <div class="card-header m-b-25">
                <h2>Export Group
                    <ul class="pull-right breadcrumb">
                        <li><a href="all-groups.html">Groups</a></li>
                        <li class="active">Export Group</li>
                    </ul>
                </h2>
            </div>
            <div class="card-body card-padding">
                Cras leo sem, egestas a accumsan eget, euismod at nunc. Praesent vel mi blandit, tempus ex gravida, accumsan dui. Sed sed aliquam augue. Nullam vel suscipit purus, eu facilisis ante. Mauris nec commodo felis.
                <div class="clearfix m-b-25"></div>

                <div class="row">
                    <div class="col-sm-6">
                        <p class="c-black f-500 m-b-20">Date From</p>
                        <div class="dtp-container fg-line">
                        <input type='text' class="form-control date-picker" placeholder="dd/mm/YYYY">
                        </div>
                    </div>

                    <div class="col-sm-6 m-b-25">
                        <p class="c-black f-500 m-b-20">Date To</p>
                        <div class="dtp-container fg-line">
                        <input type='text' class="form-control date-picker" placeholder="dd/mm/YYYY">
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-6 m-b-15">
                        <p class="f-500 c-black m-b-25">Select Format</p>
                        <select class="tag-select" data-placeholder="Choose a Country..." style="display: none;">
                            <option value="CSV">CSV</option>
                            <option value="MySQL">MySQL</option>
                            <option value="PDF">PDF</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <p class="f-500 c-black m-b-25">Select Group</p>
                        <select class="tag-select" data-placeholder="Choose a Country..." style="display: none;">
                            <option value="ALL">ALL</option>
                            <option value="ICDL">ICDL</option>
                            <option value="WPLN">WPLN</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-6 m-b-10">
                        <button class="btn bgm-red waves-effect m-t-10"><i class="zmdi zmdi-case-download"></i> &nbsp; Export Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
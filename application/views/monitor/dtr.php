    <section id="content">
        <div class="container">                    
            <div class="card">
                <div class="card-header m-b-25">
                    <h2>Daily Time Record
                        <ul class="pull-right breadcrumb">
                            <li><a href="all-groups.html">Monitor</a></li>
                            <li class="active">Daily Time Record</li>
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
                            <input type='text' id="date-from" class="form-control date-picker" placeholder="Click here...">
                            </div>                              
                        </div> 

                        <div class="col-sm-6 m-b-25">
                            <p class="c-black f-500 m-b-20">Date To</p>
                            <div class="dtp-container fg-line">
                            <input type='text' id="date-to" class="form-control date-picker" placeholder="Click here...">
                            </div>
                        </div> 
                        <div class="clearfix"></div>

                        <div class="col-sm-6 m-b-15">
                            <p class="f-500 c-black m-b-25">Select Category</p>
                            <select id="category" class="tag-select" style="display: none;">
                                <option value="">Select</option>
                                <option value="All">All</option>
                                <option value="Contact">Contact</option>
                                <option value="Level">Level</option>
                                <option value="Group">Group</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <p class="f-500 c-black m-b-25">Select Category Level</p>
                            <select id="category_level" class="tag-select" style="display: none;">                      
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-sm-6 m-b-10">
                            <button id="generate-report" class="btn bgm-red waves-effect m-t-10"><i class="zmdi zmdi-case-download"></i> &nbsp; Generate Now</button>
                        </div>

                    </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
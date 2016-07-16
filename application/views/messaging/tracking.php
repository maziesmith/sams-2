<section id="content">
    <div class="container">

        <?php $this->load->view('partials/messages') ?>

        <div class="card"><?php
            echo breadcrumbs('', 'Messages Tracking'); ?>
            <div class="table-responsive">
                <table id="messaging-tracking-table" class="table table-condensed table-vmiddle table-hover">
                    <thead>
                        <tr>
                            <th data-column-id="count_id" data-visible="true" data-type="numeric" data-sortable="false">#</th>
                            <th data-column-id="id" data-css-class="id" data-order="asc" data-visible="false" data-identifier="true">Track ID</th>
                            <th data-column-id="message" data-css-class="message" data-order="asc">Message</th>
                            <th data-column-id="member_ids" data-css-class="member_ids" data-order="asc" data-sortable="false">Member</th>
                            <th data-column-id="msisdn" data-css-class="msisdn" data-order="asc">Mobile Number</th>
                            <th data-column-id="smsc" data-css-class="smsc" data-order="asc" data-visible="false">SMSC</th>
                            <th data-column-id="status" data-css-class="status" data-order="asc">Status</th>
                            <th data-column-id="send_at" data-css-class="send_at" data-order="asc">Send at</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<section id="content">
    <div class="container">

        <?php $this->load->view('partials/messages') ?>

        <div class="card"><?php
            echo breadcrumbs('', 'Messages Tracking'); ?>
            <div class="table-responsive">
                <table id="table-track-text" class="table table-vmiddle table-condensed">
                    <tbody>
                        <tr>
                            <td id="td-scheduled" style="padding-top:20px"><i class="fa fa-envelope">&nbsp;</i>Messages: <span><?php echo count($scheduled) ?></span></td>
                            <td id="td-pending" style="padding-top:20px"><i class="fa fa-paper-plane">&nbsp;</i>Pending: <span><?php echo @$pending; ?></span></td>
                            <td id="td-success" style="padding-top:20px"><i class="fa fa-check">&nbsp;</i>Success: <span><?php echo @$success; ?></span></td>
                            <td id="td-failed" style="padding-top:20px"><i class="fa fa-close">&nbsp;</i>Failed: <span><?php echo @$failed; ?></span></td>
                            <td id="td-rejected" style="padding-top:20px"><i class="zmdi zmdi-disc-full">&nbsp;</i>Rejected: <span><?php echo @$rejected; ?></span></td>
                            <td id="td-buffered" style="padding-top:20px"><i class="fa fa-signal">&nbsp;</i>Buffered: <span><?php echo @$buffered; ?></span></td>
                        </tr>
                    </tbody>
                </table><hr class="m-t-0">
                <table id="messaging-tracking-table" class="table table-condensed table-vmiddle table-hover">
                    <thead>
                        <tr>
                            <th data-column-id="count_id" data-visible="true" data-type="numeric" data-sortable="false">#</th>
                            <th data-column-id="id" data-css-class="id" data-order="asc" data-visible="false" data-identifier="true">Track ID</th>
                            <th data-column-id="message" data-css-class="message" data-order="asc">Message</th>
                            <th data-column-id="member_ids" data-css-class="member_ids" data-order="asc" data-sortable="false">Members</th>
                            <th data-column-id="msisdn" data-css-class="msisdn" data-order="asc">Mobile Numbers</th>
                            <th data-column-id="smsc" data-css-class="smsc" data-order="asc" data-visible="false">SMSC</th>
                            <th data-column-id="status" data-css-class="status" data-order="asc">Status</th>
                            <th data-column-id="send_at" data-css-class="send_at" data-order="asc">Send at</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false" data-header-css-class="fixed-width">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
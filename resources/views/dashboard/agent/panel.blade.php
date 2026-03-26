@extends('layout.agent')

@section('main')
    <div class="content">
                
                <!-- AGENT PAGE VIEW -->
                <div id="agent-view" class="page-view active">
                    <div class="section-header">
                        <div class="section-tag">Performance Matrix</div>
                        <h2 class="section-title">Agent Overview</h2>
                    </div>

                    <div class="grid-layout">
                        <div class="card">
                            <span class="card-label">Active Float</span>
                            <div class="card-value">₦142,500.00</div>
                        </div>
                        <div class="card">
                            <span class="card-label">Daily Commission</span>
                            <div class="card-value">₦12,400.00</div>
                        </div>
                    </div>

                    <div class="section-header">
                        <div class="section-tag">Internal Functions</div>
                        <h2 class="section-title">Agent Actions</h2>
                    </div> 
                    <div class="action-strip">
                        <a href="#" class="btn-action"><span>Payout</span> <span>→</span></a>
                        <a href="#" class="btn-action"><span>Add Float</span> <span>+</span></a>
                        <a href="#" class="btn-action"><span>Issue Refund</span> <span>↺</span></a>
                    </div>

                    <div class="section-header">
                        <div class="section-tag">Data Stream</div>
                        <h2 class="section-title">Recent Activity</h2>
                    </div>

                    <div class="transaction-list">
                        <div class="trx-item">
                            <div class="trx-info">
                                <span class="trx-title">Cash Checkout</span>
                                <span class="trx-meta">#9901 • 14:20</span>
                            </div>
                            <div class="trx-amount">
                                <span class="amount-val">₦5,000.00</span>
                                <span class="status-pill">Success</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
@endsection
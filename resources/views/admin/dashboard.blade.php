@extends('layouts.app')

@section('content')
    <main class="app-main"> <!--begin::App Content Header-->

        <x-admin_breadcrumb :header="'Dashboard'" />

        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row"> <!--begin::Col-->
                    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ ($election === 0) ? 0 : \App\Models\VotingPosition::where('election_id', $election->id)->count() }}</h3>
                                <p>No. of Positions</p>
                            </div> <i class="small-box-icon bi bi-person-square"></i> <a href="{{route('voting_positions')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-arrow-right-circle-fill"></i> </a>
                        </div> <!--end::Small Box Widget 1-->
                    </div> <!--end::Col-->
                    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>{{ ($election === 0) ? 0 : \App\Models\Candidate::where('election_id', $election->id)->count() }}</h3>
                                <p>No. Candidates</p>
                            </div> <i class="small-box-icon bi bi-people-fill"></i> <a href="{{ route('candidates') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-arrow-right-circle-fill"></i> </a>
                        </div> <!--end::Small Box Widget 2-->
                    </div> <!--end::Col-->
                    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>{{ ($election === 0) ? 0 : \App\Models\Voter::where('election_id', $election->id)->count() }}</h3>
                                <p>Total Voters</p>
                            </div> <i class="small-box-icon bi bi-people"></i> <a href="{{ route('voters') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-arrow-right-circle-fill"></i> </a>
                        </div> <!--end::Small Box Widget 3-->
                    </div> <!--end::Col-->
                    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 4-->
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>{{ ($election === 0) ? 0 : \App\Models\Vote::where('election_id', $election->id)->count() }}</h3>
                                <p>Total Votes Cast</p>
                            </div> <i class="small-box-icon bi bi-check2-square"></i> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-arrow-right-circle-fill"></i> </a>
                        </div> <!--end::Small Box Widget 4-->
                    </div> <!--end::Col-->
                </div> <!--end::Row--> <!--begin::Row-->
                <div class="row"> <!-- Start col -->
                    <div class="col-lg-12 connectedSortable">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Graph on Election</h3>
                            </div>
                            <div class="card-body">
                                <div id="revenue-chart"></div>
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.Start col --> <!-- Start col -->
                </div> <!-- /.row (main row) -->
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main> <!--end::App Main--> <!--begin::Footer-->
@endsection

@php
    $positions_array = \App\Models\VotingPosition::select('position_name')->where('election_id', $election->id)->orderBy('id')->pluck('position_name');
    $positions_array2 = \App\Models\VotingPosition::select('id')->where('election_id', $election->id)->orderBy('id')->pluck('id');

    $result_array = [];

    foreach ($positions_array2 as $position){
        $votes = \App\Models\Vote::where(['election_id' => $election->id, 'voting_position_id' => $position])->count();

        $result_array[] = $votes;
    }

//    dd($positions_array, $result_array);
@endphp

@section('chart_graph')
    <!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script> <!-- sortablejs -->
    <script>
        const connectedSortables =
            document.querySelectorAll(".connectedSortable");
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: "shared",
                handle: ".card-header",
            });
        });

        const cardHeaders = document.querySelectorAll(
            ".connectedSortable .card-header",
        );
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = "move";
        });
    </script> <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script> <!-- ChartJS -->
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [
                {
                    name: "Total Votes Cast",
                    data: [<?php echo implode(", ",$result_array); ?>],
                }
            ],
            chart: {
                height: 300,
                type: "bar",
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ["#0d6efd"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                type: "names",
                categories: <?php echo $positions_array; ?>,
            },
            tooltip: {
                x: {
                    format: "MMMM yyyy",
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#revenue-chart"),
            sales_chart_options,
        );
        sales_chart.render();
    </script> <!-- jsvectormap -->
@endsection




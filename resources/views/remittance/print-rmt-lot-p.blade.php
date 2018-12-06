<html>
  <head>
    <style>
      body {
        font-family: sans-serif;
      }

      @page {
        /* Page setup */
        size: 15in 6in;
	margin: 0;
      }

      @media print {
        /* Print specific styling */
        body {
          font-family: sans-serif;
        }

	.main-frame {
	  position: relative;
	  margin: 0;
	  padding: 0;
	}

        p.rmt-header {
          margin-left: 2.5in;
          margin-top: 0.6in;
          margin-bottom: 1.5in;
        }
        p.rmt-header-b {
          margin-left: 2.5in;
          margin-top: 0.4in;
          margin-bottom: 1.5in;
        }

        .top-name {
          margin-left: 2.5in;
        }

        .top-spacer {
          margin-top: 2.5in;
        }

        .top-spacer-b {
          margin-top: 2.35in;
        }

        p.rmt-footer {
          position: relative;
          /*bottom: 2;*/
	  page-break-inside: avoid;
        }

        .rmt-footer-fc {
          position: absolute;
          left: 1cm;
        }

        .rmt-footer-date {
          position: absolute;
          left: 9cm;
        }

        .rmt-footer-sn {
          position: absolute;
          left: 21cm;
        }

        .rmt-footer-total {
          position: absolute;
          left: 26.5cm;
        }

	.page-breaker {
	  page-break-before: always;
	  margin: 0;
	  padding: 0;
	}

	/* Different margin-tops for footer */
	.ftr-mt-0 {
	  margin-top: 5.2cm;
	}
	.ftr-mt-1 {
	  margin-top: 4.4cm;
	}
	.ftr-mt-2 {
	  margin-top: 3.5cm;
	}
	.ftr-mt-3 {
	  margin-top: 2.7cm;
	}
	.ftr-mt-4 {
	  margin-top: 1.8cm;
	}
	.ftr-mt-5 {
	  margin-top: 1cm;
	}

	/* Remittance line numbers */
	.rl-swastyayani {
	    display: inline-block;
	    min-width: 1.1cm;
	}
	.rl-istavrity {
	    display: inline-block;
	    min-width: 1.8cm;
	}
	.rl-acharyavrity {
	    display: inline-block;
	    min-width: 1.7cm;
	}
	.rl-dakshina {
	    display: inline-block;
	    min-width: 1.4cm;
	}
	.rl-sangathani {
	    display: inline-block;
	    min-width: 1.4cm;
	}
	.rl-ananda_bazar {
	    display: inline-block;
	    min-width: 1.7cm;
	}
	.rl-pranami {
	    display: inline-block;
	    min-width: 1.4cm;
	}
	.rl-swastyayani_awasista {
	    display: inline-block;
	    min-width: 1.6cm;
	}
	.rl-ritwiki {
	    display: inline-block;
	    min-width: 1.4cm;
	}
	.rl-utsav {
	    display: inline-block;
	    min-width: 1.4cm;
	}
	.rl-diksha_pranami {
	    display: inline-block;
	    min-width: 1.4cm;
	}
	.rl-acharya_pranami {
	    display: inline-block;
	    min-width: 1.4cm;
	}
	.rl-parivrity {
	    display: inline-block;
	    min-width: 1.4cm;
	}
	.rl-misc {
	    display: inline-block;
	    min-width: 1.4cm;
	}

	.rl-num {
	  font-size: 13px;
	}

	.rl-p {
	    position: relative;
	    margin-top: 0;
	    margin-bottom: 0;
	    page-break-inside: avoid;
	}

	.rl-p span {
	  margin: 0;
	  margin-right: 0.2cm;
	  padding: 0;
	}

	.rl-name {
	  display: inline-block;
	  font-size: 14px;
	  min-width: 7cm;
	}
      }
    </style>
  </head>
  <body>
    @foreach ($rmtLot->remittances as $remittance)
      @if ($loop->index > 0)
        <!-- Page break after each remittance -->
        <p class="page-breaker">
          &nbsp;&nbsp;
        </p>
      @endif

      <!-- Submitter name and address -->
      <p class="
        @if ($loop->index == 0 )
          rmt-header
	@else
          rmt-header-b
	@endif
      ">
        {{ $remittance->submitter->person->first_name }}&nbsp;
        @if ($remittance->submitter->person->middle_name) 
          {{ $remittance->submitter->person->middle_name }}&nbsp;
        @endif
        {{ $remittance->submitter->person->last_name }}&nbsp;
        <br />
        {{ $remittance->family->address }}
      </p>

      <!-- Remit lines -->
      @foreach ($remittance->remittance_lines as $remittance_line)
        @if ($loop->index > 0 && $loop->index % 6 == 0)
          <!-- Page break after 6 remit lines -->
          <p class="page-breaker">
            &nbsp;&nbsp;
          </p>

          <!-- Print submitter info on top of each page -->
          <p class="rmt-header-b">
            {{ $remittance->submitter->person->first_name }}&nbsp;
            @if ($remittance->submitter->person->middle_name) 
              {{ $remittance->submitter->person->middle_name }}&nbsp;
            @endif
            {{ $remittance->submitter->person->last_name }}&nbsp;
            <br />
            {{ $remittance->family->address }}
          </p>
        @endif
        <p class="rl-p">
          <span class="rl-name">
            {{ $remittance_line->oblate->person->first_name }}
            @if ($remittance_line->oblate->person->middle_name)
              {{ $remittance_line->oblate->person->middle_name }}
            @endif
            {{ $remittance_line->oblate->person->last_name }}
          </span>

          <span class="rl-num rl-swastyayani">
            {{ $remittance_line->swastyayani }}
          </span>
          <span class="rl-num rl-istavrity">
            {{ $remittance_line->istavrity }}
          </span>
          <span class="rl-num rl-acharyavrity">
            {{ $remittance_line->acharyavrity }}
          </span>
          <span class="rl-num rl-dakshina">
            {{ $remittance_line->dakshina }}
          </span>
          <span class="rl-num rl-sangathani">
            {{ $remittance_line->sangathani }}
          </span>
          <span class="rl-num rl-ananda_bazar">
            {{ $remittance_line->ananda_bazar }}
          </span>
          <span class="rl-num rl-pranami">
            {{ $remittance_line->pranami }}
          </span>
          <span class="rl-num rl-swastyayani_awasista">
            {{ $remittance_line->swastyayani_awasista }}
          </span>
          <span class="rl-num rl-ritwiki">
            {{ $remittance_line->ritwiki }}
          </span>
          <span class="rl-num rl-utsav">
            {{ $remittance_line->utsav }}
          </span>
          <span class="rl-num rl-diksha_pranami">
            {{ $remittance_line->diksha_pranami }}
          </span>
          <span class="rl-num rl-acharya_pranami">
            {{ $remittance_line->acharya_pranami }}
          </span>
          <span class="rl-num rl-parivrity">
            {{ $remittance_line->parivrity }}
          </span>
          <span class="rl-num rl-misc">
            {{ $remittance_line->misc }}
          </span>
        </p>
        <p class="rl-p">
          <span class="rl-name">
            *{{ $remittance_line->oblate->worker->person->first_name }}
            @if ($remittance_line->oblate->worker->person->middle_name)
              {{ $remittance_line->oblate->worker->person->middle_name }}
            @endif
            {{ $remittance_line->oblate->worker->person->last_name }}
          </span>
        </p>

        <!-- Display footer info if either it is 6th line 
             OR, it is the last line.
        -->
        @if ($loop->index % 6 == 5 || $loop->last)
            <!--<p class="rmt-footer">-->
            <p class="rmt-footer
              @if ($loop->index % 6 == 0)
                ftr-mt-0
              @elseif ($loop->index % 6 == 1)
                ftr-mt-1
              @elseif ($loop->index % 6 == 2)
                ftr-mt-2
              @elseif ($loop->index % 6 == 3)
                ftr-mt-3
              @elseif ($loop->index % 6 == 4)
                ftr-mt-4
              @elseif ($loop->index % 6 == 5)
                ftr-mt-5
              @endif
            ">
              <span class="rmt-footer-fc">
                {{ $remittance->family->family_code }}
              </span>
              <span class="rmt-footer-date">
                {{ $remittance->submitted_date }}
              </span>
              <span class="rmt-footer-sn">
                {{ $remittance->remittance_id }}
              </span>
              <span class="rmt-footer-total">
                NRs: TODO
              </span>
            </p>
        @endif <!-- End footer -->
      @endforeach <!-- End remittance line -->
    @endforeach <!-- End remittance -->
  </body>
</html>

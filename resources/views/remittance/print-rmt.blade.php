<html>
  <head>
    <style>
      body {
        font-family: sans-serif;
      }

      p.rmt-header {
        position: fixed;
        top: 0.5in;
      }

      .top-name {
        margin-left: 5in;
      }

      .top-spacer {
        margin-top: 2.5in;
      }

      p.rmt-footer {
        position: fixed;
        /* bottom: 2; */
      }

      .rmt-footer-fc {
        position: fixed;
	left: 2in;
      }

      .rmt-footer-date {
        position: fixed;
	left: 4in;
      }

      .rmt-footer-sn {
        position: fixed;
	left: 6in;
      }

      .rmt-footer-total {
        position: fixed;
	left: 8in;
      }

      @page {
        /* Page setup */
        size: 15in 6in;
	margin: 0mm;
      }

      @media print {
        /* Print specific styling */
        body {
          font-family: sans-serif;
        }

        p.rmt-header {
          position: fixed;
          top: 0.5in;
        }

        .top-name {
          margin-left: 5in;
        }

        .top-spacer {
          margin-top: 2.5in;
        }

        p.rmt-footer {
          position: fixed;
          bottom: 2;
        }
      }
    </style>
  </head>
  <body>
    <!-- Submitter name and address -->
    <p class="top-name rmt-header">
      {{ $remittance->submitter->person->first_name }}&nbsp;
      @if ($remittance->submitter->person->middle_name) 
        {{ $remittance->submitter->person->middle_name }}&nbsp;
      @endif
      {{ $remittance->submitter->person->last_name }}&nbsp;
      <br />
      {{ $remittance->family->address }}
    </p>

    <!-- Spacer -->
    <p class="top-spacer">
    </p>

    <!-- Remit lines -->
    <p>
      <table class="table">
        <thead>
        </thead>
        <tbody>
          @foreach ( $remittance->remittance_lines as $remittance_line)
	    @if ($loop->index > 0 && $loop->index % 6 == 0)
	        <tr class="new-page">
		  <td>
	            <div class="top-spacer">
                      &nbsp;&nbsp;
	            </div>
		  </td>
	        </tr>
	    @endif
            <tr>
              <td>
	        <div class="rl-name">
                  {{ $remittance_line->oblate->person->first_name }}
                  @if ($remittance_line->oblate->person->middle_name)
                    {{ $remittance_line->oblate->person->middle_name }}
                  @endif
                  {{ $remittance_line->oblate->person->last_name }}
                  /*
                  {{ $remittance_line->oblate->worker->person->first_name }}
                  @if ($remittance_line->oblate->worker->person->middle_name)
                    {{ $remittance_line->oblate->worker->person->middle_name }}
                  @endif
                  {{ $remittance_line->oblate->worker->person->last_name }}
	        </div>
              </td>
              <td class="nwo-prt-num-td">{{ $remittance_line->swastyayani }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->istavrity }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->acharyavrity }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->dakshina }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->sangathani }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->ritwiki }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->pranami }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->swastyayani_awasista }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->ananda_bazar }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->parivrity }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->misc }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->utsav }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->diksha_pranami }}</td>
              <td class="nwo-prt-num-td">{{ $remittance_line->acharya_pranami }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </p>
   
    <!-- Footer -->
    <p class="rmt-footer">
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
      NRs: {{ $remTotal }}
      </span>
    </p>
  </body>
</html>

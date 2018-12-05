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
        margin-left: 3in;
      }

      .top-spacer {
        margin-top: 2.5in;
      }

      p.rmt-footer {
        position: fixed;
        /* bottom: 2; */
	  top: 4.5in;
      }

      .rmt-footer-fc {
        position: fixed;
	left: 1in;
      }

      .rmt-footer-date {
        position: fixed;
	left: 4in;
      }

      .rmt-footer-sn {
        position: fixed;
	left: 8in;
      }

      .rmt-footer-total {
        position: fixed;
	left:10in;
      }

      @page {
        /* Page setup */
        size: A3;
	margin: 0;
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
          margin-left: 2.5in;
        }

        .top-spacer {
          margin-top: 2.5in;
        }

        .top-spacer-b {
          margin-top: 2.35in;
        }

        p.rmt-footer {
          position: fixed;
	  top: 4.8in;
          /*bottom: 2;*/
	  page-break-inside: avoid;
        }

        .rmt-footer-fc {
          position: fixed;
          left: 1in;
        }

        .rmt-footer-date {
          position: fixed;
          left: 3.5in;
        }

        .rmt-footer-sn {
          position: fixed;
          left: 8.2in;
        }

        .rmt-footer-total {
          position: fixed;
          left: 10.5in;
        }

	.page-breaker {
	  page-break-before: always;
	  margin: 0;
	  padding: 0;
	}

	/* Remittance line numbers */
	.rl-swastyayani {
	    position: absolute;
	    left: 2.8in;
	}
	.rl-istavrity {
	    position: absolute;
	    left: 3.8in;
	}
	.rl-acharyavrity {
	    position: absolute;
	    left: 4.5in;
	}
	.rl-dakshina {
	    position: absolute;
	    left: 5.1in;
	}
	.rl-sangathani {
	    position: absolute;
	    left: 5.65in;
	}
	.rl-ananda_bazar {
	    position: absolute;
	    left: 6.3in;
	}
	.rl-pranami {
	    position: absolute;
	    left: 7.05in;
	}
	.rl-swastyayani_awasista {
	    position: absolute;
	    left: 7.5in;
	}
	.rl-ritwiki {
	    position: absolute;
	    left: 8.3in;
	}
	.rl-utsav {
	    position: absolute;
	    left: 8in;
	}
	.rl-diksha_pranami {
	    position: absolute;
	    left: 8.75in;
	}
	.rl-acharya_pranami {
	    position: absolute;
	    left: 9in;
	}
	.rl-parivrity {
	    position: absolute;
	    left: 9.5in;
	}
	.rl-misc {
	    position: absolute;
	    left: 10in;
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

	.rl-name {
	  font-size: 14px;
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
    @foreach ( $remittance->remittance_lines as $remittance_line)
      @if ($loop->index > 0 && $loop->index % 6 == 0)
        <p class="page-breaker">
	  &nbsp;&nbsp;
        </p>
        <p class="top-spacer-b">
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
    @endforeach
   
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

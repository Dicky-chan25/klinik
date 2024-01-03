<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block"> 
        <a href="/apotek" class="nav-link">Home</a>
      </li>
    </ul>
    <div class="datetime text-muted">
      <div class="date">
          <span id="dayname">Day</span>,
          <span id="month">Month</span>
          <span id="daynum">00</span>,
          <span id="year">Year</span>
      </div>
      <div class="time">
          <span id="hour">00</span>:
          <span id="minutes">00</span>:
          <span id="seconds">00</span>
          <span id="period">AM</span>
      </div>
    </div>
 
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
            <form action="/logout" method="post">
              @csrf
              <button type="submit" class="btn btn-info">Logout <i class="bi bi-box-arrow-right"></i></button>
            </form>
      </li>


    </ul>
  </nav> 
  <script type="text/javascript">
    function updateClock() {
        var now = new Date();
        var dname = now.getDay(),
            mo = now.getMonth(),
            dnum = now.getDate(),
            yr = now.getFullYear(),
            hou = now.getHours(),
            min = now.getMinutes(),
            sec = now.getSeconds(),
            pe = "AM";

        if (hou >= 12) {
            pe = "PM";
        }
        if (hou == 0) {
            hou = 12;
        }
        if (hou > 12) {
            hou = hou - 12;
        }

        Number.prototype.pad = function(digits) {
            for (var n = this.toString(); n.length < digits; n = 0 + n);
            return n;
        }

        var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var week = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
        var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
        var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
        for (var i = 0; i < ids.length; i++)
            document.getElementById(ids[i]).firstChild.nodeValue = values[i];
    }

    function initClock() {
        updateClock();
        window.setInterval("updateClock()", 1);
    }
</script>
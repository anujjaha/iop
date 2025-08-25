@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@include('backend.includes.datatable-asset')

@section('content')
    <div class="page">
    <div class="container-xl">
      <!-- Page Header -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">SIM & Mobile Connections — CEO Overview</h2>
            <div class="subtle">Live snapshot of active/inactive numbers, plan status, and upcoming expiries.</div>
          </div>
          <div class="col-auto no-print">
            <div class="btn-list">
              <button class="btn btn-outline" onclick="window.print()">
                <i class="ti ti-printer me-1"></i> Print
              </button>
              <button class="btn btn-primary" id="exportCsvBtn">
                <i class="ti ti-file-type-csv me-1"></i> Export CSV
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- KPI Cards -->
      <div class="row row-cards mb-3" id="kpiRow">
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="device-avatar"><i class="ti ti-device-mobile"></i></span>
                <div>
                  <div class="subtle">Total Connections</div>
                  <div class="stat" id="kpiTotal">0</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="device-avatar" style="background:#ecfeff"><i class="ti ti-circle-check"></i></span>
                <div>
                  <div class="subtle">Active</div>
                  <div class="stat" id="kpiActive">0</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="device-avatar" style="background:#f0f9ff"><i class="ti ti-alert-triangle"></i></span>
                <div>
                  <div class="subtle">Expiring ≤ 7 days</div>
                  <div class="stat" id="kpiExpiring">0</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <span class="device-avatar" style="background:#fef2f2"><i class="ti ti-circle-x"></i></span>
                <div>
                  <div class="subtle">Inactive</div>
                  <div class="stat" id="kpiInactive">0</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Controls -->
      <div class="card mb-3 no-print">
        <div class="card-body">
          <div class="row g-2 align-items-center">
            <div class="col-md-6 searchbar">
              <div class="input-icon">
                <span class="input-icon-addon"><i class="ti ti-search"></i></span>
                <input type="text" id="searchInput" class="form-control" placeholder="Search by number, device, plan..." />
              </div>
            </div>
            <div class="col-md-6 text-md-end filter-chips">
              <div class="btn-list">
                <button class="btn btn-outline" data-filter="all"><i class="ti ti-filter me-1"></i> All</button>
                <button class="btn btn-outline" data-filter="active"><i class="ti ti-circle-check me-1"></i> Active</button>
                <button class="btn btn-outline" data-filter="expiring"><i class="ti ti-alert-triangle me-1"></i> Expiring ≤ 7d</button>
                <button class="btn btn-outline" data-filter="inactive"><i class="ti ti-circle-x me-1"></i> Inactive</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Table -->
      <div class="card">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table card-table table-vcenter" id="simTable">
              <thead>
                <tr>
                  <th>Mobile Number</th>
                  <th>Status</th>
                  <th>Last Recharge</th>
                  <th>Current Plan</th>
                  <th>Expiry Date</th>
                  <th>Days Left</th>
                  <th>Attached Device</th>
                </tr>
              </thead>
              <tbody>
                <!-- Rows populated by JS -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer footer-note">
          Tip: Rows highlighted in amber are expiring within 7 days. Use the filter chips above for a quick view.
        </div>
      </div>

      <div class="my-4 text-center subtle">
        Generated dashboard • Replace demo data with your live data feed or CSV import.
      </div>
    </div>
  </div>
@endsection

@section('after-scripts')
<script>
    // ===== Demo Data (Replace with your actual dataset or API response) =====
    const SIM_DATA = {!! json_encode($simData) !!};
    console.log(SIM_DATA);
    const SIM_DATA1 = [
      {
        number: "9876543210",
        status: "Active",
        lastRecharge: "2025-08-15",
        plan: "₹299 / 28 Days",
        expiry: "2025-09-12",
        device: "Samsung A54"
      },
      {
        number: "9876500001",
        status: "Inactive",
        lastRecharge: "2025-05-01",
        plan: "—",
        expiry: "2025-05-29",
        device: "—"
      },
      {
        number: "9876512345",
        status: "Active",
        lastRecharge: "2025-08-20",
        plan: "₹719 / 84 Days",
        expiry: "2025-11-12",
        device: "iPhone 13"
      },
      {
        number: "9825012345",
        status: "Active",
        lastRecharge: "2025-08-10",
        plan: "₹239 / 28 Days",
        expiry: "2025-09-07",
        device: "JioFi Dongle"
      },
      {
        number: "9898011122",
        status: "Active",
        lastRecharge: "2025-08-05",
        plan: "₹499 / 56 Days",
        expiry: "2025-09-30",
        device: "OnePlus 12R"
      },
      {
        number: "9909012345",
        status: "Inactive",
        lastRecharge: "2025-04-10",
        plan: "—",
        expiry: "2025-05-08",
        device: "—"
      }
    ];

    const tbody = document.querySelector('#simTable tbody');

    function daysBetween(dateStr) {
      const today = new Date();
      const target = new Date(dateStr);
      // normalize time portion
      today.setHours(0,0,0,0); target.setHours(0,0,0,0);
      const ms = target - today;
      return Math.ceil(ms / (1000*60*60*24));
    }

    function fmtDate(dateStr) {
      if (!dateStr) return "—";
      const d = new Date(dateStr + 'T00:00:00');
      const options = { day: '2-digit', month: 'short', year: 'numeric' };
      return d.toLocaleDateString(undefined, options);
    }

    function statusBadge(status) {
      if (status === 'Active') return '<span class="badge bg-success-lt badge-status">Active</span>';
      return '<span class="badge bg-secondary-lt badge-status">Inactive</span>';
    }

    function daysLeftPill(days) {
      if (isNaN(days)) return '—';
      if (days < 0) return '<span class="badge bg-secondary">Expired</span>';
      if (days <= 7) return `<span class="badge bg-warning-lt">${days} days</span>`;
      return `<span class="badge bg-primary-lt">${days} days</span>`;
    }

    function progressForDays(days) {
      const total = Math.min(Math.max(28, days + 14), 84); // rough scale for bar width aesthetics
      const pct = Math.max(0, Math.min(100, Math.round(((days) / total) * 100)));
      return `
        <div class="progress" style="height:8px; max-width:160px;">
          <div class="progress-bar" role="progressbar" style="width:${pct}%;" aria-valuenow="${pct}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>`;
    }

    function renderTable(rows) {
      tbody.innerHTML = '';
      rows.forEach(rec => {
        const dleft = daysBetween(rec.expiry);
        const tr = document.createElement('tr');
        tr.classList.toggle('inactive', rec.status !== 'Active');
        tr.classList.toggle('expiring-soon', rec.status === 'Active' && dleft >= 0 && dleft <= 7);
        tr.innerHTML = `
          <td><strong>${rec.number}</strong></td>
          <td>${statusBadge(rec.status)}</td>
          <td>${fmtDate(rec.lastRecharge)}</td>
          <td>${rec.plan || '—'}</td>
          <td>${fmtDate(rec.expiry)}</td>
          <td>
            <div class="d-flex align-items-center gap-2">
              ${daysLeftPill(dleft)}
              ${progressForDays(dleft)}
            </div>
          </td>
          <td>${rec.device || '—'}</td>
        `;
        tbody.appendChild(tr);
      });

      // Update KPIs
      const total = rows.length;
      const active = rows.filter(r => r.status === 'Active').length;
      const inactive = rows.filter(r => r.status !== 'Active').length;
      const expiring = rows.filter(r => r.status === 'Active' && daysBetween(r.expiry) >= 0 && daysBetween(r.expiry) <= 7).length;
      document.getElementById('kpiTotal').textContent = total;
      document.getElementById('kpiActive').textContent = active;
      document.getElementById('kpiInactive').textContent = inactive;
      document.getElementById('kpiExpiring').textContent = expiring;
    }

    // ===== Filtering & Search =====
    let currentFilter = 'all';
    function applyFilter() {
      const q = document.getElementById('searchInput').value.toLowerCase().trim();
      const filtered = SIM_DATA.filter(r => {
        const dleft = daysBetween(r.expiry);
        let pass = true;
        if (currentFilter === 'active') pass = r.status === 'Active';
        if (currentFilter === 'inactive') pass = r.status !== 'Active';
        if (currentFilter === 'expiring') pass = r.status === 'Active' && dleft >= 0 && dleft <= 7;
        if (!pass) return false;
        if (!q) return true;
        const hay = `${r.number} ${r.status} ${r.plan} ${r.device}`.toLowerCase();
        return hay.includes(q);
      });
      renderTable(filtered);
    }

    document.querySelectorAll('[data-filter]').forEach(btn => {
      btn.addEventListener('click', () => {
        currentFilter = btn.getAttribute('data-filter');
        document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('btn-primary'));
        btn.classList.add('btn-primary');
        applyFilter();
      });
    });

    document.getElementById('searchInput').addEventListener('input', applyFilter);

    // ===== CSV Export =====
    function exportToCsv(filename, rows) {
      const headers = ['Mobile Number','Status','Last Recharge','Current Plan','Expiry Date','Days Left','Attached Device'];
      const lines = [headers.join(',')];
      rows.forEach(r => {
        const dleft = daysBetween(r.expiry);
        const line = [
          r.number,
          r.status,
          fmtDate(r.lastRecharge),
          (r.plan || '—'),
          fmtDate(r.expiry),
          isNaN(dleft) ? '' : dleft,
          (r.device || '—')
        ].map(val => `"${String(val).replace(/"/g, '""')}"`).join(',');
        lines.push(line);
      });
      const blob = new Blob([lines.join('\n')], { type: 'text/csv;charset=utf-8;' });
      const url = URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.setAttribute('href', url);
      link.setAttribute('download', filename);
      link.click();
      URL.revokeObjectURL(url);
    }

    document.getElementById('exportCsvBtn').addEventListener('click', () => {
      exportToCsv('sim-connections.csv', SIM_DATA);
    });

    // Initial render
    renderTable(SIM_DATA);
  </script>
@endsection
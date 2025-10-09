<style>
  .page-header {
    background: #182536;
    color: white;
    padding: 2rem;
    margin-bottom: 2rem;
    border-radius: 12px;
  }

  .page-header h2,
  .page-header p {
    color: white !important;
    margin: 0;
  }

  .stats-card {
    background: var(--bs-warning);
    border: none;
    color: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 0;
    height: auto;
  }

  .stats-card .card-body {
    padding: 1.5rem 1rem;
    color: white;
  }

  .stats-card h3,
  .stats-card small {
    color: white !important;
  }

  .stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }

  .action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
  }

  .action-buttons .btn {
    border-radius: 6px;
    font-weight: 500;
    padding: 6px 10px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .action-buttons .btn i {
    font-size: 14px;
  }

  .table-card {
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border-radius: 12px;
    overflow: hidden;
  }

  .table-card .card-header {
    background: white;
    padding: 1.5rem;
    border-bottom: 1px solid #dee2e6;
  }

  .table thead th {
    background: white;
    color: #182536;
    font-weight: 600;
    border-right: 1px solid #dee2e6;
    border-bottom: 2px solid #dee2e6;
    padding: 1rem;
    vertical-align: middle;
  }

  .table thead th:last-child {
    border-right: none;
  }

  .table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-right: 1px solid #f1f3f4;
  }

  .table tbody td:last-child {
    border-right: none;
  }

  .table tbody tr:hover {
    background-color: #f8f9ff;
    transition: all 0.2s ease;
  }

  .btn-create {
    background: #ffb104;
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    color: white;
    box-shadow: 0 4px 15px rgba(24, 37, 54, 0.3);
    transition: all 0.3s ease;
  }

  .btn-create:hover {
    background: #1a2a3d;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(24, 37, 54, 0.4);
    color: white;
  }

  .dropdown-toggle-btn {
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .dropdown-toggle-btn:hover {
    color: #182536;
  }

  .dropdown-toggle-btn.collapsed i {
    transform: rotate(0deg);
  }

  .dropdown-toggle-btn:not(.collapsed) i {
    transform: rotate(180deg);
  }

  .attributes-section {
    background: #f8f9fa;
    border-left: 4px solid var(--bs-warning);
    margin: 0.5rem 0;
    border-radius: 0 8px 8px 0;
  }

  .attributes-header {
    background: #e9ecef;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: between;
    align-items: center;
  }

  .attributes-list {
    padding: 1rem;
  }

  .attribute-item {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 0.75rem 1rem;
    margin-bottom: 0.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .attribute-item:last-child {
    margin-bottom: 0;
  }

  .attribute-info {
    flex-grow: 1;
  }

  .attribute-name {
    font-weight: 500;
    color: #182536;
    margin-bottom: 0.25rem;
  }

  .attribute-type {
    font-size: 0.875rem;
    color: #6c757d;
  }

  .no-attributes {
    text-align: center;
    color: #6c757d;
    font-style: italic;
    padding: 1rem;
  }
</style>

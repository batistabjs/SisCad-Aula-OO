-- bd-scripts/07_add_status_pedidos.sql
ALTER TABLE pedidos ADD COLUMN status ENUM('Novo', 'Entregue', 'Pendente', 'Cancelado') NOT NULL DEFAULT 'Novo';

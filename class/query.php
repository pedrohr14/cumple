<?php
$query='SELECT        dbo.gen_trabajador.nombre, dbo.gen_trabajador.numident, dbo.nom_categoria_ocp.str_descripcion, dbo.gen_area.descripcion
FROM            dbo.gen_trabajador INNER JOIN
                         dbo.nom_trabajadores ON dbo.gen_trabajador.idtrabajador = dbo.nom_trabajadores.idtrabajador INNER JOIN
                         dbo.nom_puestos_trb ON dbo.nom_trabajadores.idpuestotrabajo = dbo.nom_puestos_trb.idpuestotrabajo INNER JOIN
                         dbo.nom_categoria_ocp ON dbo.nom_puestos_trb.idocupacion = dbo.nom_categoria_ocp.idocupacion INNER JOIN
                         gen_area ON dbo.nom_trabajadores.idarea = dbo.gen_area.idarea
WHERE        (dbo.gen_trabajador.activo = 1) AND (NOT (dbo.gen_trabajador.numident IS NULL))';

<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');
require_once('functions.php');

Class videosturista {

    public static function search_video($limite) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, sector.nombre as sector, 
empresa.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,v.id_img_preview as 
id_imagen_vista_previa, empresa.id_logo as id_logo_empresa, 'true' as pagado from video v inner join revision_objeto r on
 v.id_revision_objeto = r.id_revision_objeto inner join empresa on r.id_empresa = empresa.id_empresa inner join sector 
 on empresa.id_sector = sector.id_sector where r.status = 'A' order by v.titulo desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_search($limite, $opcion) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, sector.nombre as sector, 
empresa.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,v.id_img_preview as 
id_imagen_vista_previa, empresa.id_logo as id_logo_empresa, 'true' as pagado from video v inner join revision_objeto r on
 v.id_revision_objeto = r.id_revision_objeto inner join empresa on r.id_empresa = empresa.id_empresa inner join sector 
 on empresa.id_sector = sector.id_sector where r.status = 'A' and v.descripcion like '$opcion%' and v.titulo like '$opcion%' order by v.titulo desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_search_limit($limite, $opcion, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, sector.nombre as sector, 
empresa.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,v.id_img_preview as 
id_imagen_vista_previa, empresa.id_logo as id_logo_empresa, 'true' as pagado from video v inner join revision_objeto r on
 v.id_revision_objeto = r.id_revision_objeto inner join empresa on r.id_empresa = empresa.id_empresa inner join sector 
 on empresa.id_sector = sector.id_sector where r.status = 'A' and v.descripcion like '$opcion%' and v.titulo like '$opcion%' order by v.titulo desc limit $limite,$contador;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_limit($contador, $limite) {
        $videos = array();
        $dbh = Conectar::con();
        $new_limit = $limite + $contador;
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, sector.nombre as sector, 
empresa.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,v.id_img_preview as 
id_imagen_vista_previa,empresa.id_logo as id_logo_empresa, 'true' as pagado, '$contador' as last_id, '$new_limit' as Limite from video v inner join revision_objeto r on
 v.id_revision_objeto = r.id_revision_objeto inner join empresa on r.id_empresa = empresa.id_empresa inner join sector 
 on empresa.id_sector = sector.id_sector where r.status = 'A' order by v.titulo desc limit $contador,$new_limit;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_limit_asc($contador, $limite) {
        $videos = array();
        $dbh = Conectar::con();
        $new_limit = $limite + $contador;
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, sector.nombre as sector, 
empresa.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,v.id_img_preview as 
id_imagen_vista_previa,empresa.id_logo as id_logo_empresa, 'true' as pagado, '$contador' as last_id, '$new_limit' as Limite from video v inner join revision_objeto r on
 v.id_revision_objeto = r.id_revision_objeto inner join empresa on r.id_empresa = empresa.id_empresa inner join sector 
 on empresa.id_sector = sector.id_sector where r.status = 'A' order by v.titulo ASC limit $contador,$new_limit;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_asc($limite) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, sector.nombre as sector, 
empresa.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,v.id_img_preview 
as id_imagen_vista_previa, empresa.id_logo as id_logo_empresa, 'true' as pagado from video v inner join revision_objeto r 
on v.id_revision_objeto = r.id_revision_objeto inner join empresa on r.id_empresa = empresa.id_empresa 
inner join sector on empresa.id_sector = sector.id_sector where r.status = 'A' order by v.titulo asc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector($limite) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_hour($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >'$uhb' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_hour_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_hour_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_day($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_day_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_day_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_week($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_week_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and  r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_week_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_month($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_month_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_month_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_year($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_year_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_year_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_limit($limite, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name($limite, $sector) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_limit($limite, $sector, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_asc($limite) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_asc_limit($limite, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa($limite) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' order by v.titulo desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_hour($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_hour_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_hour_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_day($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_day_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_day_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_week($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_week_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_week_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_month($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_month_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_month_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_year($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_year_asc($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_year_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_limit($limite, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_and_asc($limite) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_and_asc_limit($limite, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by($limite, $order_by) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector') {
            $videosbysector = videosturista::search_video_by_sector($limit);
        }
        if ($orden == 'empresa') {
            $videosbysector = videosturista::search_video_by_empresa($limit);
        }
        return $videosbysector;
    }

    public static function search_video_order_by_sector_name($limite, $order_by, $sector) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector') {
            $videosbysector = videosturista::search_video_by_sector_name_2($limit, $sector);
        }
        if ($orden == 'empresa') {
            $videosbysector = videosturista::search_video_by_empresa_name($limit, $sector);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_name_2($limite, $sector) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_name($limite, $sector) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_sector_name_asc($limite, $order_by, $sector) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector') {
            $videosbysector = videosturista::search_video_by_sector_name_asc($limit, $sector);
        }
        if ($orden == 'empresa') {
            $videosbysector = videosturista::search_video_by_empresa_name_asc($limit, $sector);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_name_asc($limite, $sector) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_name_asc($limite, $sector) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_sector_name_asc_limit($limite, $order_by, $sector, $contador) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector') {
            $videosbysector = videosturista::search_video_by_sector_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa') {
            $videosbysector = videosturista::search_video_by_empresa_name_asc_limit($limit, $sector, $contador);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_sector_name_limit($limite, $order_by, $sector, $contador) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector') {
            $videosbysector = videosturista::search_video_by_sector_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa') {
            $videosbysector = videosturista::search_video_by_empresa_name_limit($limit, $sector, $contador);
        }
        return $videosbysector;
    }

    public static function search_video_by_empresa_name_limit($limite, $sector, $contador) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and s.nombre = '$sector' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_with_date($limite, $order_by, $date_upload) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_hour($limit);
        }
        if ($orden == 'sector' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_day($limit);
        }
        if ($orden == 'sector' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_week($limit);
        }
        if ($orden == 'sector' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_month($limit);
        }
        if ($orden == 'sector' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_year($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_empresa_hour($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_empresa_day($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_empresa_week($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_empresa_month($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_empresa_year($limit);
        }
        return $videosbysector;
    }

    public static function search_video_order_by_with_sector_date($limite, $date_upload, $sector) {
        $videosbysector = array();
        if ($date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_name_hour($limite, $sector);
        }
        if ($date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_name_day($limite, $sector);
        }
        if ($date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_name_week($limite, $sector);
        }
        if ($date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_name_month($limite, $sector);
        }
        if ($date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_name_year($limite, $sector);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_name_hour($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_day($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_week($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_month($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_year($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_with_sector_date_limit($limite, $date_upload, $sector, $contador) {
        $videosbysector = array();
        if ($date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_name_hour_limit($limite, $sector, $contador);
        }
        if ($date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_name_day_limit($limite, $sector, $contador);
        }
        if ($date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_name_week_limit($limite, $sector, $contador);
        }
        if ($date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_name_month_limit($limite, $sector, $contador);
        }
        if ($date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_name_year_limit($limite, $sector, $contador);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_name_hour_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_day_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb'  and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_week_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_month_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb'  and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_name_year_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_sector_name_sector($limite, $order_by, $date_upload, $sector) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_hour_name($limit, $sector);
        }
        if ($orden == 'sector' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_day_name($limit, $sector);
        }
        if ($orden == 'sector' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_week_name($limit, $sector);
        }
        if ($orden == 'sector' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_month_name($limit, $sector);
        }
        if ($orden == 'sector' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_year_name($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_empresa_hour_name($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_empresa_day_name($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_empresa_week_name($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_empresa_month_name($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_empresa_year_name($limit, $sector);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_hour_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_day_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_week_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,v.duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_month_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_year_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb'  and s.nombre ='$sector' order by s.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_hour_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_day_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_week_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_month_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_year_name($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_sector_name_sector_asc($limite, $order_by, $date_upload, $sector) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_hour_name_asc($limit, $sector);
        }
        if ($orden == 'sector' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_day_name_asc($limit, $sector);
        }
        if ($orden == 'sector' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_week_name_asc($limit, $sector);
        }
        if ($orden == 'sector' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_month_name_asc($limit, $sector);
        }
        if ($orden == 'sector' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_year_name_asc($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_empresa_hour_name_asc($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_empresa_day_name_asc($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_empresa_week_name_asc($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_empresa_month_name_asc($limit, $sector);
        }
        if ($orden == 'empresa' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_empresa_year_name_asc($limit, $sector);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_hour_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_day_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_week_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_month_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_year_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb'  and s.nombre ='$sector' order by s.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_hour_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_day_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_week_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_month_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_year_name_asc($limite, $sector) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre ASC limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    //
    public static function search_video_order_by_sector_name_sector_asc_limit($limite, $order_by, $date_upload, $sector, $contador) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_hour_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_day_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_week_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_month_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_year_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_empresa_hour_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_empresa_day_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_empresa_week_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_empresa_month_name_asc_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_empresa_year_name_asc_limit($limit, $sector, $contador);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_hour_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_day_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_week_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_month_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_year_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_hour_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_day_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_week_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_month_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_year_name_asc_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_sector_name_sector_limit($limite, $order_by, $date_upload, $sector, $contador) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_hour_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_day_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_week_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_month_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_year_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_empresa_hour_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_empresa_day_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_empresa_week_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_empresa_month_name_limit($limit, $sector, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_empresa_year_name_limit($limit, $sector, $contador);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_hour_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_day_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_week_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_month_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb'  and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_year_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by s.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_hour_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' and s.nombre ='$sector' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_day_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_week_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' and s.nombre ='$sector' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_month_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_year_name_limit($limite, $sector, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' and s.nombre ='$sector' order by e.nombre  desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_with_date_asc($limite, $order_by, $date_upload) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_hour_asc($limit);
        }
        if ($orden == 'sector' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_day_asc($limit);
        }
        if ($orden == 'sector' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_week_asc($limit);
        }
        if ($orden == 'sector' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_month_asc($limit);
        }
        if ($orden == 'sector' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_year_asc($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_empresa_hour_asc($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_empresa_day_asc($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_empresa_week_asc($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_empresa_month_asc($limit);
        }
        if ($orden == 'empresa' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_empresa_year_asc($limit);
        }
        return $videosbysector;
    }

    public static function search_video_order_by_with_date_asc_limit($limite, $order_by, $date_upload, $contador) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_hour_asc_limit($limit, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_day_asc_limit($limit, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_week_asc_limit($limit, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_month_asc_limit($limit, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_year_asc_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_empresa_hour_asc_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_empresa_day_asc_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_empresa_week_asc_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_empresa_month_asc_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_empresa_year_asc_limit($limit, $contador);
        }
        return $videosbysector;
    }

    public static function search_video_by_sector_hour_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_day_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_week_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_month_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_sector_year_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by s.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_hour_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_day_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 day');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_week_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_month_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_empresa_year_asc_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by e.nombre ASC limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_with_date_limit($limite, $order_by, $date_upload, $contador) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_sector_hour_limit($limit, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_sector_day_limit($limit, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_sector_week_limit($limit, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_sector_month_limit($limit, $contador);
        }
        if ($orden == 'sector' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_sector_year_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'H') {
            $videosbysector = videosturista::search_video_by_empresa_hour_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'T') {
            $videosbysector = videosturista::search_video_by_empresa_day_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'W') {
            $videosbysector = videosturista::search_video_by_empresa_week_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'M') {
            $videosbysector = videosturista::search_video_by_empresa_month_limit($limit, $contador);
        }
        if ($orden == 'empresa' && $date_upload == 'Y') {
            $videosbysector = videosturista::search_video_by_empresa_year_limit($limit, $contador);
        }
        return $videosbysector;
    }

    public static function search_video_order_by_limit($limite, $order_by, $contador) {
        $videosbysector = array();
        $limit = $limite;
        $orden = $order_by;
        if ($orden == 'sector') {
            $videosbysector = videosturista::search_video_by_sector_limit($limit, $contador);
        }
        if ($orden == 'empresa') {
            $videosbysector = videosturista::search_video_by_empresa_limit($limit, $contador);
        }
        return $videosbysector;
    }

    //
    public static function search_video_order_by_date_limit($limite, $date_upload, $contador) {
        $videosbydate = array();
        $limit = $limite;
        $date = $date_upload;
        if ($date == 'H') {
            $videosbydate = videosturista::search_video_by_hour_limit($limit, $contador);
        }
        if ($date == 'T') {
            $videosbydate = videosturista::search_video_by_day_limit($limit, $contador);
        }
        if ($date == 'W') {
            $videosbydate = videosturista::search_video_by_week_limit($limit, $contador);
        }
        if ($date == 'M') {
            $videosbydate = videosturista::search_video_by_month_limit($limit, $contador);
        }
        if ($date == 'Y') {
            $videosbydate = videosturista::search_video_by_year_limit($limit, $contador);
        }
        return $videosbydate;
    }

    public static function search_video_by_hour_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d h:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by v.id_video desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_day_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d h:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by v.id_video desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_week_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by v.id_video desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_month_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by v.id_video desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_year_limit($limite, $contador) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by v.id_video desc limit $contador,$limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_date($limite, $date_upload) {
        $videosbydate = array();
        $limit = $limite;
        $date = $date_upload;
        if ($date == 'H') {
            $videosbydate = videosturista::search_video_by_hour($limit);
        }
        if ($date == 'T') {
            $videosbydate = videosturista::search_video_by_day($limit);
        }
        if ($date == 'W') {
            $videosbydate = videosturista::search_video_by_week($limit);
        }
        if ($date == 'M') {
            $videosbydate = videosturista::search_video_by_month($limit);
        }
        if ($date == 'Y') {
            $videosbydate = videosturista::search_video_by_year($limit);
        }
        return $videosbydate;
    }

    public static function search_video_by_hour($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('- 1 hour');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion > '$uhb' order by v.id_video desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_day($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $dt->modify('today');
        $uhb = $dt->format("Y-m-d H:i:s");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by v.id_video desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_week($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $fdotw = Funcionnes::set_firts_day_of_week();
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$fdotw' and r.fecha_actualizacion <= '$ha' order by v.id_video desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_month($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-m-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by v.id_video desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_by_year($limite) {
        $videos = array();
        $ha = date('Y-m-d H:i:s');
        $dt = new DateTime($ha);
        $uhb = $dt->format("Y-01-01 00:00:00");
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(r.fecha_actualizacion, '%d/%m/%Y') as fecha_subida, s.nombre as sector, 
e.nombre as empresa,date_format(v.duracion, '%i:%s') as duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,
v.id_img_preview as id_imagen_vista_previa, e.id_logo as id_logo_empresa, 'true' as pagado from video v inner join 
revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa e on r.id_empresa = e.id_empresa inner join 
sector s on e.id_sector = s.id_sector where r.status = 'A' and r.fecha_actualizacion >= '$uhb' order by v.id_video desc limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

    public static function search_video_order_by_asc($limite, $order_by) {
        $videosbysector = array();
        $limit = $limite;
        if ($order_by == 'sector') {
            $videosbysector = videosturista::search_video_by_sector_asc($limit);
        }
        if ($order_by == 'empresa') {
            $videosbysector = videosturista::search_video_by_empresa_and_asc($limit);
        }
        return $videosbysector;
    }

    public static function search_video_order_by_asc_limit($limite, $order_by, $contador) {
        $videosbysector = array();
        $limit = $limite;
        if ($order_by == 'sector') {
            $videosbysector = videosturista::search_video_by_sector_asc_limit($limit, $contador);
        }
        if ($order_by == 'empresa') {
            $videosbysector = videosturista::search_video_by_empresa_and_asc_limit($limit, $contador);
        }
        return $videosbysector;
    }

}

//include 'mdlSeguridad.php';
$videos = array();
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("HTTP/1.0 405 Method Not Allowed");
    exit();
}
//Filtro principal el cual solo toma el limite
if (isset($_GET['limit'])) {
    $limite = $_GET['limit'];
    $videos = videosturista::search_video($limite);
}
//Filtro de la busquedad
if (isset($_GET['limit']) && isset($_GET['q'])) {
    $limite = $_GET['limit'];
    $opcion = $_GET['q'];
    $videos = videosturista::search_video_search($limite, $opcion);
}
//Filtro de la busquedad con limite
if (isset($_GET['limit']) && isset($_GET['q']) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $opcion = $_GET['q'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_search_limit($limite, $opcion, $contador);
}
//Filtrar principal y con el ultimo last_id
if (isset($_GET['limit']) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_limit($contador, $limite);
}
//Filtrar de manera escendente
if (isset($_GET['limit']) && isset($_GET["sort"])) {
    $limite = $_GET['limit'];
    $videos = videosturista::search_video_asc($limite);
}
//Filtrar principal y con el ultimo last_id y de manera ascendente
if (isset($_GET['limit']) && isset($_GET['last_id']) && isset($_GET["sort"])) {
    $limite = $_GET['limit'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_limit_asc($contador, $limite);
}
//Filtro cuando se envia el limite y el el metodo por el cual se van a ordenar ya se por empresa o por sector
if (isset($_GET['limit']) && isset($_GET["order_by"])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $videos = videosturista::search_video_order_by($limite, $order_by);
}
//Filtrar por medio de la fecha de actualizacion
if (isset($_GET['limit']) && isset($_GET["date_upload"])) {
    $date_upload = $_GET['date_upload'];
    $videos = videosturista::search_video_order_by_date($limite, $date_upload);
}
//Filtrar por medio de la fecha de actualizacion y el limite
if (isset($_GET['limit']) && isset($_GET["date_upload"]) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $contador = $_GET['last_id'];
    $date_upload = $_GET['date_upload'];
    $videos = videosturista::search_video_order_by_date_limit($limite, $date_upload, $contador);
}
//Filtrar por sector
if (isset($_GET['limit']) && isset($_GET["sector"])) {
    $sector = $_GET['sector'];
    $videos = videosturista::search_video_by_sector_name($limite, $sector);
}
//Filtrar por sector y por el ultimo id que se recibio
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET['last_id'])) {
    $sector = $_GET['sector'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_by_sector_name_limit($limite, $sector, $contador);
}
//Filtro cuando se envia el limite y el el metodo por el cual se van a ordenar ya se por empresa o por sector y de forma ascendente
if (isset($_GET['limit']) && isset($_GET["order_by"]) && isset($_GET["sort"])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $videos = videosturista::search_video_order_by_asc($limite, $order_by);
}

//Filtro cuando se envia el limite y el el metodo por el cual se van a ordenar ya se por empresa o por sector y de forma ascendente y con un limite
if (isset($_GET['limit']) && isset($_GET["order_by"]) && isset($_GET["sort"]) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_asc_limit($limite, $order_by, $contador);
}

//Filtro cuando se envia el limite y el el metodo por el cual se van a ordenar ya se por empresa o por sector y con un limite
if (isset($_GET['limit']) && isset($_GET["order_by"]) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_limit($limite, $order_by, $contador);
}
//Filtro cuando se recibe un limite, un orden y en que fecha se requiere
if (isset($_GET['limit']) && isset($_GET["order_by"]) && isset($_GET["date_upload"])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $date_upload = $_GET['date_upload'];
    $videos = videosturista::search_video_order_by_with_date($limite, $order_by, $date_upload);
}
//Filtro para ordear por sector y fechas cuando son mas de dos videos
if (isset($_GET['limit']) && isset($_GET["order_by"]) && isset($_GET["date_upload"]) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $date_upload = $_GET['date_upload'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_with_date_limit($limite, $order_by, $date_upload, $contador);
}

//Filtro cuando se recibe un limite, un orden y en que fecha se requiere y se ordenana ascendetemente
if (isset($_GET['limit']) && isset($_GET["order_by"]) && isset($_GET["date_upload"]) && isset($_GET["sort"])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $date_upload = $_GET['date_upload'];
    $videos = videosturista::search_video_order_by_with_date_asc($limite, $order_by, $date_upload);
}
//Filtro cuando se recibe un limite, un orden y en que fecha se requiere y se ordenana ascendetemente cuando se obtiene el last_ide
if (isset($_GET['limit']) && isset($_GET["order_by"]) && isset($_GET["date_upload"]) && isset($_GET["sort"]) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $date_upload = $_GET['date_upload'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_with_date_asc_limit($limite, $order_by, $date_upload, $contador);
}

//Filtro cuando se recibe un limite, un orden y en que fecha se requiere y se ordenana ascendetemente cuando se obtiene el last_ide
if (isset($_GET['limit']) && isset($_GET["order_by"]) && isset($_GET["date_upload"]) && isset($_GET["sort"]) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $order_by = $_GET['order_by'];
    $date_upload = $_GET['date_upload'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_with_date_asc_limit($limite, $order_by, $date_upload, $contador);
}
//Filtrar por sector y por nombre de sector
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["order_by"])) {
    $sector = $_GET['sector'];
    $order_by = $_GET['order_by'];
    $videos = videosturista::search_video_order_by_sector_name($limite, $order_by, $sector);
}
//Filtrar por sector y por nombre de sector y evitar que se repitan
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["order_by"]) && isset($_GET['last_id'])) {
    $sector = $_GET['sector'];
    $order_by = $_GET['order_by'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_sector_name_limit($limite, $order_by, $sector, $contador);
}

//Filtrar por sector y por nombre de sector ascendentes
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["order_by"]) && isset($_GET["sort"])) {
    $sector = $_GET['sector'];
    $order_by = $_GET['order_by'];
    $videos = videosturista::search_video_order_by_sector_name_asc($limite, $order_by, $sector);
}

//Filtrar por sector y por nombre de sector ascendentes con un limitante
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["order_by"]) && isset($_GET["sort"]) && isset($_GET['last_id'])) {
    $sector = $_GET['sector'];
    $order_by = $_GET['order_by'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_sector_name_asc_limit($limite, $order_by, $sector, $contador);
}

//Filtrar por sector y fecha
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["date_upload"])) {
    $limite = $_GET['limit'];
    $sector = $_GET['sector'];
    $date_upload = $_GET['date_upload'];
    $videos = videosturista::search_video_order_by_with_sector_date($limite, $date_upload, $sector);
}

//Filtrar por sector y fecha y un limitante
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["date_upload"]) && isset($_GET['last_id'])) {
    $limite = $_GET['limit'];
    $sector = $_GET['sector'];
    $date_upload = $_GET['date_upload'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_with_sector_date_limit($limite, $date_upload, $sector, $contador);
}
//Filtrar por sector y por nombre de sector por un orden y por fecha
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["order_by"]) && isset($_GET["date_upload"])) {
    $sector = $_GET['sector'];
    $order_by = $_GET['order_by'];
    $videos = videosturista::search_video_order_by_sector_name_sector($limite, $order_by, $date_upload, $sector);
}

//Filtrar por sector y por nombre de sector por un orden y por fecha con limitante
if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["order_by"]) && isset($_GET["date_upload"]) && isset($_GET['last_id'])) {
    $sector = $_GET['sector'];
    $order_by = $_GET['order_by'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_sector_name_sector_limit($limite, $order_by, $date_upload, $sector, $contador);
}

if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["order_by"]) && isset($_GET["date_upload"]) && isset($_GET["sort"])) {
    $sector = $_GET['sector'];
    $order_by = $_GET['order_by'];
    $videos = videosturista::search_video_order_by_sector_name_sector_asc($limite, $order_by, $date_upload, $sector);
}

if (isset($_GET['limit']) && isset($_GET["sector"]) && isset($_GET["order_by"]) && isset($_GET["date_upload"]) && isset($_GET["sort"]) && isset($_GET['last_id'])) {
    $sector = $_GET['sector'];
    $order_by = $_GET['order_by'];
    $contador = $_GET['last_id'];
    $videos = videosturista::search_video_order_by_sector_name_sector_asc_limit($limite, $order_by, $date_upload, $sector, $contador);
}
echo json_encode($videos);

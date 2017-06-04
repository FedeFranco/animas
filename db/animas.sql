drop table if exists categorias cascade;
create table categorias (
    id bigserial constraint pk_categorias primary key,
    nombre_categoria varchar(20) not null
);

drop table if exists tipos_animales cascade;
create table tipos_animales (
    id bigserial constraint pk_tipos_animales primary key,
    nombre_tipo_animal varchar(20) not null
);

drop table if exists publicaciones cascade;
create table publicaciones(
    id bigserial constraint pk_publicaciones primary key,
    cuerpo text not null,
    url varchar(255),
    titulo varchar(50) not null,
    latitud varchar(255) not null,
    longitud varchar(255) not null,
    telf_contacto numeric(9) not null,
    fecha_publicacion timestamptz default current_timestamp,
    tipo_animal_id bigint constraint fk_tipo_animal_publicacion references tipos_animales (id)
                on delete no action on update cascade,
    categoria_id bigint constraint fk_categoria_publicacion references categorias (id)
                on delete no action on update cascade,
    usuario_id bigint constraint fk_usuario_publicacion references public.user(id) on
                delete set null on update cascade

);

drop table if exists reportes cascade;
create table reportes(
    id bigserial constraint pk_reportes primary key,
    reportador_id bigint constraint fk_usuario_reportador references public.user(id) on
                delete set null on update cascade,
    reportado_id bigint constraint fk_usuario_reportado references public.user(id) on
                delete set null on update cascade,
    publicacion_id bigint constraint fk_publicacion_reportes references publicaciones(id) on
                delete set null on update cascade,
    cuerpo text not null
);



insert into categorias (nombre_categoria) values ('ADOPCIÓN'),
                                                    ('ACOGIDA'),
                                                        ('APADRINAMIENTO'),
                                                            ('ALERTA');

insert into tipos_animales (nombre_tipo_animal) values ('FELINO'),('CANINO'),('AVES'),('REPTIL')

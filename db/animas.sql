drop table if exists categorias cascade;
create table categorias (
    id bigserial constraint pk_categorias primary key,
    nombre_categoria varchar(20) not null
);

drop table if exists alertas cascade;
create table alertas (
    id bigserial constraint pk_alertas primary key,
    categoria_id bigint constraint fk_categoria_alerta references categorias (id)
                on delete no action on update cascade,
    usuario_id bigint constraint fk_usuario_alerta references public.user(id) on
                delete no action on update cascade
);

drop table if exists publicaciones cascade;
create table publicaciones(
    id bigserial constraint pk_publicaciones primary key,
    cuerpo text not null,
    titulo varchar(50) not null,
    categoria_id bigint constraint fk_categoria_publicacion references categorias (id)
                on delete no action on update cascade,
    usuario_id bigint constraint fk_usuario_publicacion references public.user(id) on
                delete set null on update cascade

);

insert into categorias (nombre_categoria) values ('ADOPCIÓN'),
                                                    ('ACOGIDA'),
                                                        ('APADRINAMIENTO');

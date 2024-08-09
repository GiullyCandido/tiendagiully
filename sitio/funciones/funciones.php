<?php 


function catalogo_completo(){
    $productos = [
        [
            "id" => 1,
            "nombre" => "Bolso Twist West",
            "marca" => "Louis Vuitton",
            "precio" => 3600,
            "descripcion" => "El nuevo bolso Twist West es una reinterpretación del icónico modelo de la Maison. Confeccionado en piel Epi en una gama de tonos modernos, presenta una elegante forma alargada y un cierre LV Twist exquisitamente elaborado. Este accesorio cuenta con capacidad suficiente para guardar las pertenencias imprescindibles y puede llevarse de diferentes formas mediante una cadena y una bandolera extraíble.",
            "tipodeproducto" => "Bolso",
            "talla" => "Unica. 23.5 x 12 x 7 cm (Largo x Alto x Ancho)",
            "imagen" => "BolsoTwistWest.png"
        ],
        [
            "id" => 2,
            "nombre" => "Bolso Pico Looping",
            "marca" => "Louis Vuitton",
            "precio" => 1900,
            "descripcion" => "Este bolso Pico Looping está elaborado en lona Monogram Dune, un material visto en el desfile Crucero 2024 de Louis Vuitton. Destaca por un diseño distintivo con solapa en forma de media luna, que incluye un asa superior en piel. Se completa con una cadena de color dorado, ajustable y extraíble, para llevarlo de diferentes maneras.",
            "tipodeproducto" => "Bolso",
            "talla" => "Unica. 15.5 x 11 x 4 cm (Largo x Alto x Ancho)",
            "imagen" => "BolsoPicoLooping.png"
        ],
        [
            "id" => 3,
            "nombre" => "Bolso Mini Moon",
            "marca" => "Louis Vuitton",
            "precio" => 1500,
            "descripcion" => "Esta versión de temporada del bolso Mini Moon está confeccionada en piel Monogram Empreinte con un elegante diseño bicolor. Su distintiva silueta, que da nombre al modelo, se adorna con piezas metálicas de color dorado. Este accesorio compacto ofrece espacio para los imprescindibles, como el teléfono, la cartera y el labial, e incluye una bandolera ajustable que permite llevarlo al hombro, en el brazo o en la mano.",
            "tipodeproducto" => "Bolso",
            "talla" => "Unica. 20.5 x 11 x 5 cm (Largo x Alto x Ancho)",
            "imagen" => "BolsoMiniMoon.png"
        ],
        [
            "id" => 4,
            "nombre" => "Bolso Twist MM",
            "marca" => "Louis Vuitton",
            "precio" => 3900,
            "descripcion" => "Este bolso Twist MM está confeccionado en piel Epi granulada. Puede llevarse en la mano mediante las tres finas cadenas, así como al hombro o cruzado si dos de ellas se acoplan a la bandolera en piel. Estas piezas metálicas y el cierre LV Twist lucen un acabado iridiscente que evoca el brillo de los escarabajos.",
            "tipodeproducto" => "Bolso",
            "talla" => "Unica. 23 x 17 x 9.5 cm (Largo x Alto x Ancho)",
            "imagen" => "BolsoTwistMM.png"
        ],
        [
            "id" => 5,
            "nombre" => "Bolso Capucines East-West Mini",
            "marca" => "Louis Vuitton",
            "precio" => 5900,
            "descripcion" => "Este bolso Capucines Mini, actualizado con una nueva y moderna forma horizontal, permite llevar un teléfono móvil, una cartera compacta y otros pequeños artículos imprescindibles. Está confeccionado en exquisita piel de becerro realzada con piezas metálicas de acabado mate, que le confieren un aire actual. Además de los emblemáticos detalles distintivos del modelo original, incluye una bandolera ajustable de cadena y piel trenzada para lucirlo al hombro o cruzado.",
            "tipodeproducto" => "Bolso",
            "talla" => "Unica. 22 x 12 x 8 cm (Largo x Alto x Ancho)",
            "imagen" => "BolsoCapucinesEast-WestMini.png"
        ],
        [
            "id" => 6,
            "nombre" => "Polo de punto",
            "marca" => "Prada",
            "precio" => 1100,
            "descripcion" => "Este polo de punto reinterpreta un clásico de la ropa de hombre con líneas contemporáneas y detalles elegantes. Este modelo con proporciones extragrandes luce elementos en contraste como el cuello de camisa de popelín y los puños de punto acanalado, mientras que el logo bordado de la parte frontal completa la prenda con un toque icónico.",
            "tipodeproducto" => "Ropa",
            "talla" => "M",
            "imagen" => "Polodepunto.png"
        ],
        [
            "id" => 7,
            "nombre" => "Polo de piqué",
            "marca" => "Prada",
            "precio" => 490,
            "descripcion" => "Este polo de piqué con detalles clásicos presenta una silueta de corte entallado. El logo triangular de metal esmaltado completa este modelo con un toque icónico.",
            "tipodeproducto" => "Ropa",
            "talla" => "S",
            "imagen" => "PoloDePique.png"
        ],
        [
            "id" => 8,
            "nombre" => "Camisa de sarga estampada",
            "marca" => "Prada",
            "precio" => 1650,
            "descripcion" => "Esta camisa de sarga de seda con cuello de camisa de bolera tiene una silueta inspirada en la ropa de hombre con detalles retro. El modelo de manga corta y líneas holgadas está adornado con un gran estampado de una flor que reproduce una imagen de la campaña de la temporada otoño-invierno 2023 “In Conversation with a Flower”. El logo triangular de tela, reinterpretado como un diseño conceptual, remata la prenda con el icónico sello de la marca.",
            "tipodeproducto" => "Ropa",
            "talla" => "L",
            "imagen" => "CamisaDeSargaEstampada.png"
        ],
        [
            "id" => 9,
            "nombre" => "Falda con vuelo de Re-Nylon",
            "marca" => "Prada",
            "precio" => 1800,
            "descripcion" => "Las líneas amplias y los volúmenes elegantes conforman la silueta de esta falda de encanto femenino, reinterpretada con el toque práctico del Re-Nylon. El innovador nylon regenerado aporta modernidad a este diseño atemporal con ribetes de piel, que define un estilo capaz de combinar los códigos Prada con detalles inesperados. El logo triangular de metal esmaltado, sublimado por la base de piel, completa el look con una nota icónica.",
            "tipodeproducto" => "Ropa",
            "talla" => "M",
            "imagen" => "FaldaConVueloDeRe-Nylon.png"
        ],
        [
            "id" => 10,
            "nombre" => "Chaqueta corta convertible de plumón y terciopelo",
            "marca" => "Prada",
            "precio" => 2200,
            "descripcion" => "Volúmenes extragrandes y nuevos materiales se mezclan para crear un nuevo concepto de ropa de abrigo que refleja la característica dualidad de las colecciones Prada. Esta chaqueta corta de plumón y terciopelo revela su versátil espíritu híbrido, transformándose en un chaleco gracias a las mangas extraíbles. El emblemático logo triangular de metal esmaltado de la marca decora el diseño.",
            "tipodeproducto" => "Ropa",
            "talla" => "M",
            "imagen" => "ChaquetaCortaConvertible.png"
        ],
        [
            "id" => 11,
            "nombre" => "Camisa de popelín bordada",
            "marca" => "Prada",
            "precio" => 1250,
            "descripcion" => "Camisa de popelín de corte masculino, caracterizada por su silueta holgada de líneas rectas. El diseño, con detalles clásicos, cobra vida gracias al toque contemporáneo del fantástico adorno floral de color en contraste que dibuja la silueta de una flor. El logo triangular de tela en la parte posterior completa el look con un toque icónico.",
            "tipodeproducto" => "Ropa",
            "talla" => "L",
            "imagen" => "CamisaDePopelInBordada.png"
        ],
        [
            "id" => 12,
            "nombre" => "Mocasines de charol Monolith",
            "marca" => "Prada",
            "precio" => 990,
            "descripcion" => "Los mocasines Monolith de Prada, confeccionados en elegante charol, dan un giro original y novedoso al clásico mocasín. Bautizado en honor a su suela chunky, este calzado es una expresión de un diseño atemporal, monolítico y único por la investigación, la innovación y el estilo que lo caracterizan.",
            "tipodeproducto" => "Zapatos",
            "talla" => 38,
            "imagen" => "MocasinesDeCharolMonolith.png"
        ],
        [
            "id" => 13,
            "nombre" => "Nari Flowers Flat",
            "marca" => "Jimmy Choo",
            "precio" => 1725,
            "descripcion" => "La bota plana Nari es una evolución de la bota de combate básica, confeccionada en piel de napa. Este botín clásico mantiene su estilo relajado pero con un toque femenino en forma de flores tonales adornadas en el lateral. El modelo es ajustable con cierre de cordones y se cierra con cremallera lateral. Los tachuelas de diamantes detallan los ojales de los cordones superiores, aportando un toque vanguardista al diseño. Este estilo se puede combinar tanto con conjuntos de mezclilla como con vestidos de día en tus looks de fin de semana.",
            "tipodeproducto" => "Zapatos",
            "talla" => 37,
            "imagen" => "NariFlowersFlat.png"
        ],
        [
            "id" => 14,
            "nombre" => "Jean Paul Gaultier Bing 90",
            "marca" => "Jimmy Choo",
            "precio" => 2450,
            "descripcion" => "El icónico Bing se reinventa en colaboración con Jean Paul Gaultier, inspirándose en el archivo de joyería distintivo y de vanguardia de la marca. El brazalete característico de Bing se reinventa como una pieza de joyería asimétrica de latón decorada con cristales. La cadena metálica comienza en la parte delantera y continúa en la parte trasera del zapato, abrazando el talón, donde se remata con una placa metálica forrada en piel. Está construido con un tacón de aguja cincelado, complementado con una suela lacada con un logo impreso digital con ambas marcas.",
            "tipodeproducto" => "Zapatos",
            "talla" => 36,
            "imagen" => "JimmyChooJeanPaulGaultierBing90.png"
        ],
        [
            "id" => 15,
            "nombre" => "Bing Flat",
            "marca" => "Jimmy Choo",
            "precio" => 975,
            "descripcion" => "Nuestras bailarinas BING en charol negro son modernas y elegantes. Su bonito diseño sin cordones lo convierte en un estilo único a la vez que cómodo y versátil. Con una correa con detalles de cristal en la parte superior del pie para darle un toque de glamour y hacerlo el ajuste perfecto para transformar un atuendo del día a la noche.",
            "tipodeproducto" => "Zapatos",
            "talla" => 38,
            "imagen" => "BingFlat.png"
        ],
        [
            "id" => 16,
            "nombre" => "Bing 100",
            "marca" => "Jimmy Choo",
            "precio" => 1095,
            "descripcion" => "Bing en charol de lino es moderno y elegante. Su hermoso diseño sin cordones lo convierte en un estilo único y enfatiza el efecto de alargamiento de las piernas con su altura de tacón de 100 mm. Con una correa con detalles de cristal en la parte superior del pie para darle un toque de glamour, lo que lo hace perfecto para combinar con un vestido para una salida nocturna sofisticada.",
            "tipodeproducto" => "Zapatos",
            "talla" => 35,
            "imagen" => "Bing100.png"
        ]
    ];

    return $productos;
    
}

?>

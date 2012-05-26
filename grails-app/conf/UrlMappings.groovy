class UrlMappings {

	static mappings = {
        "/plugins/**"(controller: 'plugins')
        "/images/**"(controller: 'images')
        "/css/**"(controller: 'images')
        "/js/**"(controller: 'js')
        "/g/$controller/$action?/$id?" {
            constraints {
                // apply constraints here
            }
        }

        "/g" {
            controller = "product"
            action = "index"
        }

        "500"(view: '/error')
	}
}

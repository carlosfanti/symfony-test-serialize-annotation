The instalation process of this project was:

> symfony new symfony-test-serialize-annotation

Then install components
> symfony composer req symfony/serializer-pack
> symfony composer req maker --dev
> symfony composer req orm

Then create controllers to each test, using maker:
> EntitySerializeController
> DTOSerializeController

The first one is to test the annotations @Ignore and @Group on a Entity Class
The second to test on a Custom Class

Both only worked when ignore attributes using the context aproach.

The routes to check:
> /entity/normalize
> /entity/normalize/grouped
> /entity/serialize
> /entity/serialize/grouped
> /entity/serialize/context
> 
> /dto/normalize
> /dto/normalize/grouped
> /dto/serialize
> /dto/serialize/grouped
> /dto/serialize/context
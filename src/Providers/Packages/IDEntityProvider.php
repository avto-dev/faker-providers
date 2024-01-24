<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Packages;

use AvtoDev\IDEntity\IDEntity;
use AvtoDev\IDEntity\Types\TypedIDEntityInterface;
use AvtoDev\FakerProviders\Providers\AbstractFakerProvider;
use AvtoDev\FakerProviders\Providers\Identifiers\GrzProvider;
use AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider;
use AvtoDev\FakerProviders\Providers\Identifiers\StsProvider;
use AvtoDev\FakerProviders\Providers\Identifiers\VinProvider;
use AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider;
use AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider;
use AvtoDev\FakerProviders\Providers\Identifiers\CadastralNumberProvider;
use AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider;

/**
 * @property-read TypedIDEntityInterface $idEntity
 */
class IDEntityProvider extends AbstractFakerProvider
{
    /**
     * Generate random IDEntity object.
     *
     * @param string|null $id_type If null passed - will be generated IDEntity with random type
     *
     * @return TypedIDEntityInterface
     */
    public function idEntity(?string $id_type = null): TypedIDEntityInterface
    {
        /** @var string $id_type */
        $id_type = \is_string($id_type) && IDEntity::typeIsSupported($id_type)
            ? $id_type
            : $this->generator->randomElement(...[IDEntity::getSupportedTypes()]);

        switch ($id_type) {
            case IDEntity::ID_TYPE_VIN:
                $this->lazyLoad(VinProvider::class);

                return IDEntity::make($this->generator->vinCode(), $id_type);

            case IDEntity::ID_TYPE_GRZ:
                $this->lazyLoad(GrzProvider::class);

                return IDEntity::make($this->generator->grzCode(), $id_type);

            case IDEntity::ID_TYPE_STS:
                $this->lazyLoad(StsProvider::class);

                return IDEntity::make($this->generator->stsCode(), $id_type);

            case IDEntity::ID_TYPE_PTS:
                $this->lazyLoad(PtsProvider::class);

                return IDEntity::make($this->generator->ptsCode(), $id_type);

            case IDEntity::ID_TYPE_BODY:
                $this->lazyLoad(BodyProvider::class);

                return IDEntity::make($this->generator->bodyCode(), $id_type);

            case IDEntity::ID_TYPE_CHASSIS:
                $this->lazyLoad(ChassisProvider::class);

                return IDEntity::make($this->generator->chassisCode(), $id_type);

            case IDEntity::ID_TYPE_DRIVER_LICENSE_NUMBER:
                $this->lazyLoad(DriverLicenseNumberProvider::class);

                return IDEntity::make($this->generator->driverLicenseNumber(), $id_type);

            case IDEntity::ID_TYPE_CADASTRAL_NUMBER:
                $this->lazyLoad(CadastralNumberProvider::class);

                return IDEntity::make($this->generator->cadastralNumber(), $id_type);
        }

        // @codeCoverageIgnoreStart
        return IDEntity::make('unknown identity type', IDEntity::ID_TYPE_UNKNOWN);
        // @codeCoverageIgnoreEnd
    }

    /**
     * Load faker provider if needed.
     *
     * @param string $provider_class
     *
     * @return void
     */
    private function lazyLoad(string $provider_class): void
    {
        $loaded = \array_map('\\get_class', $this->generator->getProviders());

        if (! \in_array($provider_class, $loaded, true)) {
            $this->generator->addProvider(new $provider_class($this->generator));
        }
    }
}

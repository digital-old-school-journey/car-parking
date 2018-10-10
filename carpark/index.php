<?php
    include_once("autoload.php");
    use App\Helper\MyHelper;
    use App\Repository\ConfigurationRepository;
    use App\Model\Configuration;

    $config_repo = new ConfigurationRepository();

    $config = new Configuration();
    $config->configuration_id = 1;
    $config->no_of_car_in_zone_monthly = 3;
    $config->no_of_car_out_zone_monthly = 5;

    $result = $config_repo->save($config);

    $result = $config_repo->find(1);
    var_dump($result);
?>
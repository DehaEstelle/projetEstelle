<?php
    require_once "../App/Views/inc/header.php";
?>
<body>
    <h2>Liste des services</h2>
    <form action="/ServiceController/insertService" method="POST">
            <label for="service">Service</label>
            <input type="hidden" id="id" name="id">
            <input type="text" id="service" name="service">

        <button type="submit" name="ajouter">Sauvegarder</button>
    </form>

    <table class="table">
        <thead>
            <th>N°</th>
            <th>Nom service</th>
            <th>Editer</th>
            <th>Supprimer</th>
        </thead>
        <tbody>
            <?php foreach($arr as $key => $value) : ?>
            <tr class="list">
                <td><?= $value["service_id"] ;?></td>
                <td><?= $value["service_lib"] ;?></td>  
                <td class="colSvg">
                    <button type="submit" name="edit" class="service">
                            <svg fill="yellow" viewBox="0 0 24 24" width="15" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                    </button>
                </td>
                <td class="colSvg"> 
                    <form action="/ServiceController/deleteService" method="post">

                        <input type="hidden" name="service_id" value="<?= $value["service_id"] ;?>">
                            
                        <button type="submit" name="delete">
                            <svg fill="red" viewBox="0 0 24 24" width="15" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="/js/service.js"></script> 
</body>
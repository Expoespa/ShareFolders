$shares = Get-SmbShare | Select-Object Name, Path

$xml = "<SHAREFOLDERS>`n"
foreach ($share in $shares) {

    $xml += "<NAME>" + $share.Name + "</NAME>`n"
    $xml += "<PATH>" + $share.Path + "</PATH>`n"

    $readUsers = @()
    $changeUsers = @()
    $fullUsers = @()

    $permissions = Get-SmbShareAccess -Name $share.Name
    foreach ($permission in $permissions) {
        if ($permission.AccessRight -eq "Read") {
            $readUsers += $permission.AccountName
        } elseif ($permission.AccessRight -eq "Change") {
            $changeUsers += $permission.AccountName
        } elseif ($permission.AccessRight -eq "Full") {
            $fullUsers += $permission.AccountName
        }
    }

    $xml += "<READPERMISSION>" + ($readUsers -join ",") + "</READPERMISSION>`n"
    $xml += "<CHANGEPERMISSION>" + ($changeUsers -join ",") + "</CHANGEPERMISSION>`n"
    $xml += "<FULLPERMISSION>" + ($fullUsers -join ",") + "</FULLPERMISSION>`n"

    $xml += "</SHAREFOLDERS>"
    [Console]::WriteLine($xml)
    [Console]::OutputEncoding = [System.Text.Encoding]::UTF8
    $xml = "<SHAREFOLDERS>`n"
